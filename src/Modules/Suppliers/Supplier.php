<?php

namespace Vikuraa\Modules\Suppliers;

use Vikuraa\Modules\People\Person;

class Supplier extends Person
{
    /*
    person_id => NO => integer
    company_name => NO => character varying
    agency_name => NO => character varying
    account_number => YES => character varying
    tax_id => YES => character varying
    deleted => YES => boolean
    category => NO => smallint
    */
    protected string $companyName;
    protected string $agencyName;
    protected ?string $accountNumber;
    protected ?int $taxId;
    protected ?bool $deleted;
    protected int $category;

    public static function fromDbArray(array $data): static
    {
        $supplier = parent::fromDbArray($data);

        $supplier->companyName = $data['company_name'];
        $supplier->agencyName = $data['agency_name'];
        $supplier->accountNumber = $data['account_number'];
        $supplier->taxId = $data['tax_id'];
        $supplier->deleted = $data['deleted'];
        $supplier->category = $data['category'];

        return $supplier;
    }

}