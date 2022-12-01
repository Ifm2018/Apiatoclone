### UpdateUserTask
```php 
if (is_string($userData->password)) {
$userData->additional([
'password' => Hash::make($userData->password),
]);
}
```

make repository to automatically return DTO instead of Eloquent Models
return UserDTO::from($this->repository->update($userData->toArray(), $userData->id));

### namespace App\Ship\Parents\Transformers;
maybe add a Transformable interface ? to make sure isAdmin is available in parent transformer? Idk! It is using it wrong there!
The Trait is in Authorization container! user Models is using it somewhere else! we just need to make sure that the isAdmin is available in the parent transformer!
and make it clear where it is coming from!


should we create an interface for transformers and force them to only take DTOs in their transform() methods?

### ParentData
make these methods available in it maybe?
```php 
getResourceKey(),
getHashedKey(),
```
maybe create an interface based on the parent data? and make sure that the parent data is implementing it?

### UpdateUserController
inject action in run() method or in the Controller constructor? why?  
I don't think it matters for testing! but it is better to inject it in the constructor! because well it is called a constructor because it 
constructs and prepare the state and needs of the class! and the `__invoke()` method is just a method that is called to run the action!

### should we validate data in DTOs?
should we split the validation rules in DTOs and Requests?  
we can do this. it makes sense logically, but it makes things way more complicated.
