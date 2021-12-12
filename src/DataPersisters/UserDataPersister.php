<?php
namespace App\DataPersisters;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface
{
    
    private $manager;
    private $encode;
    private $request;
    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $encode)
    {
      $this->manager=$manager;
      $this->encode = $encode;
    }

    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
      $pwd_encoder = $this->encode->hashPassword($data, $data->getPassword());
      $data->setPassword($pwd_encoder);
      $this->manager->persist($data);
      $this->manager->flush();
      return $data;
    }

    public function remove($data, array $context = [])
    {
      // $data->setStatut(!$data->getStatut()); 
    //   $this->manager->persist($data);
      $this->manager->flush();
      // call your persistence layer to delete $data
      return $data;
    }

    
}