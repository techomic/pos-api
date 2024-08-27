<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Modules\People\Person;

class Customer extends Person
{
    protected $companyName;
    protected $accountNumber;
    protected $taxable;
    protected $taxId;
    protected $salesTaxCodeId;
    protected $discount;
    protected $discountType;
    protected $packageId;
    protected $points;
    protected $deleted;
    protected $date;
    protected $employeeId;
    protected $consent;

    public static function fromDbArray(array $data): static
    {
        $customer = parent::fromDbArray($data);

        $customer->companyName = $data['company_name'];
        $customer->accountNumber = $data['account_number'];
        $customer->taxable = $data['taxable'];
        $customer->taxId = $data['tax_id'];
        $customer->salesTaxCodeId = $data['sales_tax_code_id'];
        $customer->discount = $data['discount'];
        $customer->discountType = $data['discount_type'];
        $customer->packageId = $data['package_id'];
        $customer->points = $data['points'];
        $customer->deleted = $data['deleted'];
        $customer->date = $data['date'];
        $customer->employeeId = $data['employee_id'];
        $customer->consent = $data['consent'];

        return $customer;
    }
}