# CreditorBankAccount

The bank account details of the creditor (recipient) for Verification of Payee.


## Fields

| Field                                                                            | Type                                                                             | Required                                                                         | Description                                                                      | Example                                                                          |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `accountHolderName`                                                              | *string*                                                                         | :heavy_check_mark:                                                               | The full name of the creditor account holder to verify against bank records.     | Jan Jansen                                                                       |
| `format`                                                                         | [Components\AccountNumberFormat](../../Models/Components/AccountNumberFormat.md) | :heavy_check_mark:                                                               | The format of the account number.                                                | iban                                                                             |
| `accountNumber`                                                                  | *string*                                                                         | :heavy_check_mark:                                                               | The bank account details of the creditor.                                        | NL02ABNA0123456789                                                               |