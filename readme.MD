# TP-LINK M7000 - M7200 Modem API
tpMIFI 4G LTE Modem API.

###Login and reboot device
```php 
$tp = new \TPLink\TPLinkM7200("MODEM_PASSWORD");
$l = $tp->authentication();
$tp->rebootDevice($l->getToken());
```
###About encryption

The modem uses 2 encryption methods, these are: **`AES`** and **`RSA`** encryption methods.

example post data
```json
{
  "data":"896PxtQw9XZsQGxHQ+pT3arDvAxGzzWitDTBFVLAqk3KrZ3/2HT10gRMmHuUrnWymZI7jQIdP1mNfwW++rbdy3sdksT4su690Si5xlKKKx/XLe22lk5ItMYZy7bbfz7T",
  "sign":"3daaf3e1447ab187b68a7b9736d85b2cc511f709d6c73e48e02e0a0b560d15dbe1ed116bc2f98452e73571202238cc117560bc2cb8dd3e6dd42a8d73c0b65cb082cec0e45c6b7d199bcbce9fbbd7c343b92dff2eb69ee5aac32f89ccc91706a461ceb964ac84c2247a00fa96d64637401bf486004a05443f308c8175e984f4b7"
}
```
```json
{
  "data" : "ENCRYPTED AES DATA",
  "sign" : "ENCRYPTED RSA DATA"
}
```
