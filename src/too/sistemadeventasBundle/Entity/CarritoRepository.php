<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CarritoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarritoRepository extends EntityRepository
{
    public function getTotal($user){
        return $this->getEntityManager()->createQuery(
            'SELECT SUM(car.total) FROM toosistemadeventasBundle:Carrito car WHERE car.idUsu = :user'
        )
            ->setParameter('user',$user)
            ->getOneOrNullResult();
    }
}
