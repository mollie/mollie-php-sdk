# TransactionType

Indicates what kind of transaction this is.

We may introduce new transaction types as we expand the product. We recommend building your integration
to handle unexpected values gracefully, so nothing breaks when that happens. 


## Values

| Name                | Value               |
| ------------------- | ------------------- |
| `CardPayment`       | card-payment        |
| `BankTransfer`      | bank-transfer       |
| `PspTransfer`       | psp-transfer        |
| `InternalTransfer`  | internal-transfer   |
| `IdealPayment`      | ideal-payment       |
| `Fee`               | fee                 |
| `Correction`        | correction          |
| `DirectDebit`       | direct-debit        |
| `DirectDebitRefund` | direct-debit-refund |
| `RewardsPayout`     | rewards-payout      |