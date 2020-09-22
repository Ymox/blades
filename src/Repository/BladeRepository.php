<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Func;

class BladeRepository extends EntityRepository
{
    /**
     *
     * @param array $criteria
     * @return array ['relevance' => (int), 0 => (Blade)]
     */
    public function search(array $criteria)
    {
        $qb = $this->createQueryBuilder('b');
        $criteria = array_filter($criteria);
        $dqlCriteria = $qb->expr()->orX();
        $counts = array();
        foreach ($criteria as $criterion => $values) {
            if ($criterion == 'gender') {
                $alias = 'b';
                $dqlCriterion = $qb->expr()->in($alias . '.' . $criterion, ':' . $criterion);
                $counts[] = new Func('IF', array($dqlCriterion, 1, 0));
            } else if ($criterion == 'strength') {
                $alias = 'b';
                $dqlCriterion = $qb->expr()->gte($alias . '.' . $criterion, ':' . $criterion);
                $counts[] = new Func('IF', array($dqlCriterion, 1, 0));
            } else if ($criterion == 'skills') {
                $alias = substr($criterion, 0, 1);
                $dqlCriterion = $qb->expr()->in($alias . '.id', ':' . $criterion);
                $qb ->leftJoin('b.' . $criterion, 'b' . $alias)
                    ->leftJoin('b' . $alias . '.' . substr($criterion, 0, -1), $alias, \Doctrine\ORM\Query\Expr\Join::WITH, $dqlCriterion);
                $counts[] = $qb->expr()->countDistinct($alias . '.id');
            } else {
                $alias = substr($criterion, 0, 1);
                $dqlCriterion = $qb->expr()->in($alias . '.id', ':' . $criterion);
                $qb ->leftJoin('b.' . $criterion, $alias, \Doctrine\ORM\Query\Expr\Join::WITH, $dqlCriterion);
                $counts[] = $qb->expr()->countDistinct($alias . '.id');
            }
            $dqlCriteria->add($dqlCriterion);
            $qb->setParameter(':' . $criterion, $values);
        }
        $qb ->where($dqlCriteria)
            ->andWhere($qb->expr()->lte('b.rareness', $qb->expr()->literal(5)))
            ->addSelect(implode(' + ', array_unique(array_map(function ($count) { return (string)$count; }, $counts))) . ' AS relevance')
            ->groupBy('b.id')
            ->orderBy($qb->expr()->desc('relevance'))
            ->addOrderBy($qb->expr()->asc('b.trustLevel'))
            ->addOrderBy($qb->expr()->asc('b.name'));
        return $qb->getQuery()->getResult();
    }
}
