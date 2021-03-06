## KrameWork\HTTP\MIMEValidationHeader : HTTPHeader

***Table of Contents***
* **Overview** - Information about the class.
* **Functions** - Comprehensive list of all functions in the class.

___
### Overview
`MIMEValidationHeader` is a class used to generate a header to enable verification of MIME content-type for resources. The class is intended to be used along-side the `HTTPHeaders` class, however can be used as a standalone if desired.
___
### Functions
##### > getFieldName() : `string`
Get the field name for this header.

##### > getFieldValue() : `string`
Get the field value for this header.

##### > apply() : `void`
Apply this header to the current response.

##### > __toString() : `string`
Get the compiled header string.