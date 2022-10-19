<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureFields(string $pageCommande): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('chambre'),
            DateField::new('date_arrivee', "Date d'arrivée")->setFormat('d/M/Y'),
            DateField::new('date_depart', "Date de départ")->setFormat('d/M/Y'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            TelephoneField::new('telephone'),
            MoneyField::new('prix_total')->setCurrency('EUR')->hideOnForm(),
            // MoneyField::new('prix_total')->AssociationField::new('chambre' 'prix_journalier'),
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $pr = new $entityFqcn;
        $pr->setDateEnregistrement(new \DateTime);
        return $pr;
    }
}
