<?php

namespace Vikuraa\Modules\Customers;

use Vikuraa\Core\Model;
use Vikuraa\Modules\People\PersonModel;

class CustomerModel extends Model
{
    public function save(Customer $customer)
    {
        $sql = "
            insert into customers (
                company_name,
                account_number,
                taxable,
                tax_id,
                sales_tax_code_id,
                discount,
                discount_type,
                package_id,
                points,
                employee_id,
                consent
            ) values (
                :company_name,
                :account_number,
                :taxable,
                :tax_id,
                :sales_tax_code_id,
                :discount,
                :discount_type,
                :package_id,
                :points,
                :employee_id,
                :consent
            )
        ";

        $args = [
            'company_name' => $customer->companyName,
            'account_number' => $customer->accountNumber,
            'taxable' => $customer->taxable,
            'tax_id' => $customer->taxId,
            'sales_tax_code_id' => $customer->salesTaxCodeId,
            'discount' => $customer->discount,
            'discount_type' => $customer->discountType,
            'package_id' => $customer->packageId,
            'points' => $customer->points,
            'employee_id' => $customer->employeeId,
            'consent' => $customer->consent,
        ];

        if ((new PersonModel($this->container))->save($customer)) {
            return $this->db->execute($sql, $args, true);
        }
    }

    public function exists(int $id): bool
    {
        $sql = "
            select *
            from customers
            where person_id = :customer_id
        ";

        $args = [
            'customer_id' => $id,
        ];

        return $this->db->count($sql, $args) > 0;
    }

    public function accountNumberExists(string $accountNumber): bool
    {
        $sql = "
            select *
            from customers
            where account_number = :account_number
        ";

        $args = [
            'account_number' => $accountNumber,
        ];

        return $this->db->count($sql, $args) > 0;
    }

    public function total(): int
    {
        $sql = "
            select *
            from customers
            where deleted = false
        ";

        return $this->db->count($sql);
    }

    public function all(): Customers
    {
        $sql = "
            select *
            from customers
            left join people on customers.person_id = people.person_id
            where deleted = false
        ";

        $customers = new Customers();

        foreach ($this->db->query($sql) as $data) {
            $customers->add(Customer::fromDbArray($data));
        }

        return $customers;
    }

    public function byId(int $id): Customer
    {
        $sql = "
            select *
            from customers
            left join people on customers.person_id = people.person_id
            where customers.person_id = :person_id
        ";

        $args = [
            'person_id' => $id,
        ];

        return Customer::fromDbArray($this->db->query($sql, $args)[0]);
    }

    public function updateRewardPoints(int $customerId, int $points): bool
    {
        $sql = "
            update customers
            set points = :points
            where person_id = :person_id
        ";

        $args = [
            'points' => $points,
            'person_id' => $customerId,
        ];

        return $this->db->execute($sql, $args);
    }

    public function delete(int $id)
    {
        if ($this->config->getValue('enforce_privacy')) {
            $sql = "
                update customers
                set deleted = true
                where person_id = :person_id
            ";
        } else {
            $sql = "
                delete from customers
                where person_id = :person_id
            ";
        }
    }
}