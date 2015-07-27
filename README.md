# Age Validator
## Symfony Custom Constraint

Use this custom constraint validator to validate the age of your users and more.

```
AppBundle\Entity\MyUser
    properties:
        birthDate:
            - Date: ~
            - AppBundle\Validator\Constraints\Age:
            	min: # The minimum age allowed.
            	max: # The maximum age allowed.
            	scale: # The scale on which the age will be compared.  Can be one of the following [years, months, days]
            	minAgeMessage: # Your custom minimum age message.  Defaults to 'Must be more than %age% %scale% old.'
            	maxAgeMessage: # You custom max age message.  Defaults to 'Must be less than %age% %scale% old.'
```