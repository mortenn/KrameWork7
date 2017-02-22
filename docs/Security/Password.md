## KrameWork\Security\Password

***Table of Contents***
* **Overview** - Information about the class.
* **Example** - Example usage of the class.
* **Functions** - Comprehensive list of all functions in the class.

___
### Overview
`Password` is a basic wrapper class for passwords. It provides common features associated with passwords, such as hashing and masking. It's important to note that by itself, this class does not add any extra security to the transfer of passwords, it is simply a helper class.
___
### Example
Below is an example of this class in action.
```php
$pass = new Password('hunter10');

// Get the MD5 hash of this password.
print($pass->asMD5Hash()); // > ebb071e0e0440fd3fd1b2522279fde09

// Get a mask of this password.
print($pass->asMask()); // > ********

// Get the plaintext password.
print($pass); // > hunter10
```
___
### Functions
##### > __construct() : `void`
Password constructor.

parameter | type | description
--- | --- | ---
`$value` | `string` | Plaintext password.

##### > asMD5Hash() : `string`
Return the password as an MD5 hash. Note: MD5 hashes are just that, hashes, not encryption.

##### > asMask() : `string`
Return a mask of this password.

##### > __toString() : `string`
Get the plain-text password contained by this object.