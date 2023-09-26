## Prerequisites

It is assumed that before installing this assignement on the computer already installed
- Git
- PHP v.8.1 or higher
- Composer

and available bash to run installation script.  

For local containerization is used [Laravel Sail](https://laravel.com/docs/10.x/sail)

## Setup

After git repository cloned, run
```
composer install
```
To prepare project for local usage use command 
```
bash make.sh
```
This scrip creates `.env` file if it does not exist, afterward starts Sail container and runs fresh migration for db. 
No more actions required to start project.  

Use [Laravel Sail](https://laravel.com/docs/10.x/sail) commands to stop container or other operations if required.

Now you can access API at http://localhost 

### Start container later

If project already initialized to start container you can use

```
./vendor/bin/sail up -d
```

## API Reference

All POST requests header 
```
Accept: application/json
```

**POST** `/api/loan/` - Create new loan

### Parameters

- **amountInCents** *(integer)*: The principal loan amount in cents.
- **term** *(integer)*: The loan term in months.
- **interestRateInBasisPoints** *(integer)*: The initial interest rate in basis points (1 basis point = 0.01%).
- **euriborRateInBasisPoints** *(integer)*: The initial Euribor rate in basis points (1 basis point = 0.01%).

*All parameters are required 

### Respnse

* **loanId**: Id on newly created loan
* **repaymentPlan**: json with repayment plan details
```json
{
  "1": {
    "principalPaymentInCents": (integer),
    "interestPaymentInCents": (integer),
    "euriborPaymentInCents": (integer),
    "totalPaymentInCents": (integer)
  },
  ...
  "12": {
    "principalPaymentInCents": (integer),
    "interestPaymentInCents": (integer),
    "euriborPaymentInCents": (integer),
    "totalPaymentInCents": (integer)
  }     
}
```

### Response code
* 200 - success
* 422 - validation error

**POST** `/api/loan/euribor/adjust` - Adjust Euribor for loan

### Parameters

- **loanId** *(integer)*: ID of loan.
- **segmentNr** *(integer)*: Number of month when Euribor is changed. Allowed values between 1 and *term* of loan 
- **euriborRateInBasisPoints** *(integer)*: The Euribor rate in basis points (1 basis point = 0.01%).

*All parameters are required

### Respnse

* **loanId**: loan ID
* **repaymentPlan**: json with recalculated repayment plan details
```json
{
  "1": {
    "principalPaymentInCents": (integer),
    "interestPaymentInCents": (integer),
    "euriborPaymentInCents": (integer),
    "totalPaymentInCents": (integer)
  },
  ...
  "12": {
    "principalPaymentInCents": (integer),
    "interestPaymentInCents": (integer),
    "euriborPaymentInCents": (integer),
    "totalPaymentInCents": (integer)
  }     
}
```

### Response code
* 200 - success
* 422 - validation error

## Tests

Tests can be executed with command

```
./vendor/bin/sail artisan test
```

## Assignment execution details 

* Calculating repayment plan is used *half round up* principle after all calculations for current segment are done.
* For last month is used *last month adjustment* in cases, when total principal differs from initial loan amount.
* In assignment description last parameter of loan creation endpoint is described as *percentage*, I used more consequent *in basis points*
* In current implementation calculation plan is not stored for loan. In real project would be more correct to store calculation for further reference.
* I decided to use Laravel Sail for containerization as most convenient way, though for real life task some other solutions cold be used if needed.
* Root url (http://localhost) displays this readme file.
