<?php

namespace App\Serializer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DoctrineDenormalizer implements DenormalizerInterface
{


    private $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }


    /**
     * Appel quand on a besoin de denormalizer
     * @param mixed $data : la valeur que tente de denormaliser (ici un id)
     * @param string $type : le type que l'on veux obtenir ici une entitée
     * @param string|null $format
     */
    public function supportsDenormalization($data, string $type, ?string $format = null)
    {
        //?je sais traiter le cas où $data est un ID 
        
        //?je sais traiter le cas ou $type est un entity
        $dataIsId = is_numeric($data);
        // $type : App\Entity\Genre
        $typeIsEntity = strpos($type, 'App\\Entity') === 0; //Ma chaine commence par App\Entity

        //je réponds oui si les deux sont vrais
        return $typeIsEntity && $dataIsId;

    }


    /**
     * Appel quand on a besoin de denormalizer
     * @param mixed $data : la valeur que tente de denormaliser (ici un id)
     * @param string $type : le type que l'on veux obtenir ici une entitée
     * @param string|null $format
     * @param array $context
     */
    public function denormalize($data, string $type, ?string $format = null, array $context = [])
    {
        //? ici on veut faire appel à Doctrine
        //? pour faire un find sur l'id fournit

        //* $type = App\Entity\Genre
        //* $data = 2

        $denormalizedEntity = $this->entityManagerInterface->find($type, $data);
        return $denormalizedEntity;
        
    }
}