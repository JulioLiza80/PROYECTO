<?php

namespace App\Entity;

use App\Repository\CampaniasRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CampaniasRepository::class)]
#[Vich\Uploadable]
class Campanias
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
 //imagen1
    #[Vich\UploadableField(mapping: 'campania', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
 //imagen2
    #[Vich\UploadableField(mapping: 'campania', fileNameProperty: 'imageName2', size: 'imageSize2')]
    private ?File $imageFile2 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize2 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt2 = null;

    //imagen3
    #[Vich\UploadableField(mapping: 'campania', fileNameProperty: 'imageName3', size: 'imageSize3')]
    private ?File $imageFile3 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize3 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt3 = null;

    //imagen4

    #[Vich\UploadableField(mapping: 'campania', fileNameProperty: 'imageName4', size: 'imageSize4')]
    private ?File $imageFile4 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize4 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt4 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    //METODOS....................................................

    //imagen1
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

     //imagen2
     public function setImageFile2(?File $imageFile2 = null): void
     {
         $this->imageFile2 = $imageFile2;
 
         if (null !== $imageFile2) {
             // It is required that at least one field changes if you are using doctrine
             // otherwise the event listeners won't be called and the file is lost
             $this->updatedAt = new \DateTimeImmutable();
         }
     }
 
     public function getImageFile2(): ?File
     {
         return $this->imageFile2;
     }
 
     public function setImageName2(?string $imageName2): void
     {
         $this->imageName2 = $imageName2;
     }
 
     public function getImageName2(): ?string
     {
         return $this->imageName2;
     }
 
     public function setImageSize2(?int $imageSize2): void
     {
         $this->imageSize2 = $imageSize2;
     }
 
     public function getImageSize2(): ?int
     {
         return $this->imageSize2;
     }

      //imagen3
      public function setImageFile3(?File $imageFile3 = null): void
      {
          $this->imageFile3 = $imageFile3;
  
          if (null !== $imageFile3) {
              // It is required that at least one field changes if you are using doctrine
              // otherwise the event listeners won't be called and the file is lost
              $this->updatedAt = new \DateTimeImmutable();
          }
      }
  
      public function getImageFile3(): ?File
      {
          return $this->imageFile3;
      }
  
      public function setImageName3(?string $imageName3): void
      {
          $this->imageName3 = $imageName3;
      }
  
      public function getImageName3(): ?string
      {
          return $this->imageName3;
      }
  
      public function setImageSize3(?int $imageSize3): void
      {
          $this->imageSize3 = $imageSize3;
      }
  
      public function getImageSize3(): ?int
      {
          return $this->imageSize3;
      }
      //imagen4
      public function setImageFile4(?File $imageFile4 = null): void
      {
          $this->imageFile4 = $imageFile4;
  
          if (null !== $imageFile4) {
              // It is required that at least one field changes if you are using doctrine
              // otherwise the event listeners won't be called and the file is lost
              $this->updatedAt = new \DateTimeImmutable();
          }
      }
  
      public function getImageFile4(): ?File
      {
          return $this->imageFile4;
      }
  
      public function setImageName4(?string $imageName4): void
      {
          $this->imageName4 = $imageName4;
      }
  
      public function getImageName4(): ?string
      {
          return $this->imageName4;
      }
  
      public function setImageSize4(?int $imageSize4): void
      {
          $this->imageSize4 = $imageSize4;
      }
  
      public function getImageSize4(): ?int
      {
          return $this->imageSize3;
      }

}
