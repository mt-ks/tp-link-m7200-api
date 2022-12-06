# TP-LINK M7000 - M7200 Modem API
tpMIFI 4G LTE Modem API.

### Login and reboot device
```php 
$tp = new \TPLink\TPLinkM7200("MODEM_PASSWORD");
$l = $tp->authentication();
$tp->rebootDevice($l->getToken());
```
### About encryption

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

## Modules and Actions

### Module: alg
* getConfig: 0
* setConfig: 1

### Module: apBridge
* getConfig: 0
* setConfig: 1
* connectAp: 2
* scanAp: 3
* checkConnStatus: 4

### Module: authenticator
* load: 0
* login: 1
* getAttempt: 2
* logout: 3
* update: 4

### Module: connectedDevices
* getConfig: 0
* editName: 1

### Module: dmz
* getConfig: 0
* setConfig: 1

### Module: flowstat
* getConfig: 0
* setConfig: 1

### Module: lan
* getConf: 0
* setConf: 1

### Module: log
* getLog: 0
* clearLog: 1
* saveLog: 2
* refresh: 3
* setMdLog: 4
* getMdLog: 5

### Module: macFilters
* getBlack: 0
* setBlack: 1

### Module: message
* getConfig: 0
* setConfig: 1
* readMsg: 2
* sendMsg: 3
* saveMsg: 4
* delMsg: 5
* markRead: 6
* getSendStatus: 7

### Module: portTriggering
* getConfig: 0
* setConfig: 1
* delPT: 2

### Module: powerSave
* getConfig: 0
* setConfig: 1

### Module: restoreConf
* restoreConf: 0

### Module: reboot
* reboot: 0
* powerOff: 1

### Module: simLock
* getConfig: 0
* enablePin: 1
* disablePin: 2
* updatePin: 3
* unlockPin: 4
* unlockPuk: 5
* autoUnlock: 6

### Module: status
* getStatus: 0

### Module: storageShare
* getConf: 0
* setConf: 1

### Module: time
* getConf: 0
* saveConf: 1
* queryTime: 2

### Module: update
* getConfig: 0,
* checkNew: 1,
* serverUpdate: 2,
* pauseLoad: 3,
* reqLoadPercentage: 4,
* checkUploadResult: 5,
* startUpgrade: 6,
* clearCache: 7,
* ignoredFW: 8,
* remindMe: 9,
* upgradeNow: 10

### Module: upnp
* getConfig: 0
* setConfig: 1
* getUpnpDevList: 2

### Module: virtualServer
* getConfig: 0
* setConfig: 1
* delVS: 2

### Module: voice
* getConfig: 0
* sendUssd: 1
* cancelUssd: 2
* getSendStatus: 3

### Module: wan
* getConfig: 0,
* saveConfig: 1,
* addProfile: 2,
* deleteProfile: 3,
* wzdAddProfile: 7,
* setNetworkSelectionMode: 8,
* quaryAvailabelNetwork: 9,
* getNetworkSelectionStatus: 10,
* getDisconnectReason: 11,
* cancelSearch: 14,
* updateISP: 15,
* bandSearch: 16,
* getBandSearchStatus: 17,
* setSelectedBand: 18,
* cancelBandSearch: 19

### Module: webServer
* getLang: 0,
* setLang: 1,
* keepAlive: 2,
* unsetDefault: 3,
* getModuleList: 4,
* getFeatureList: 5,
* getWithoutAuthInfo: 6

### Module: wlan
* getConfig: 0
* setConfig: 1
* setNoneWlan: 2

### Module: wps
* get: 0
* set: 1
* start: 2
* cancel: 3

### Modules: authenticator, webServer, webCgi, authCgi
* login: 1
* keepAlive: 2
* close: 3
* update: 4
