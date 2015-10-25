<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UsuarioRepository
 */
class UsuarioRepository extends EntityRepository
{
    public function validarUser($user,$email){
        return $this->getEntityManager()->createQuery(
            'SELECT u FROM toosistemadeventasBundle:Usuario u WHERE u.usuario = :user OR u.correo = :email'
        )
            ->setParameters(array('user'=>$user,'email'=>$email))
            ->getOneOrNullResult();
    }
}
