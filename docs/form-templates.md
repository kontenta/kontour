# Form templates

[The form views](../resources/views/forms/)
generate form inputs along with labels and validation feedback.

Pull them into your Blade views using `@include` or `@component`, like this:

```php
<form ...>
@include('kontour::forms.input', ['name' => 'username', 'type' => 'email'])
</form>
```

The form views will prefill inputs with data from a `$model` variable if it is set in the Blade view,
so you may just pass an Eloquent model to the view.

[Laravel's `$errors` bag](https://laravel.com/docs/validation#quick-displaying-the-validation-errors)
is used to display errors for inputs.
If you have [named error bags](https://laravel.com/docs/validation#named-error-bags) in your view,
you can put one of those bags into the `$errors` variable by including a partial view.
This is actually a good pattern for scoping variables to one of the forms on your page, if you have more than one.

```php
@include('my_form_partial', ['errors' => $errors->my_form_bag, 'model' => $user])
```

If the `$errors` bag contains any errors,
[old input data from the previous request](https://laravel.com/docs/helpers#method-old)
will be used to repopulate the form.

The `id` attribute is set automatically on created elements that need it,
and it's usually derived from the `$name` variable.
If you get an id conflict on a page where two inputs may have the same name,
e.g. in different forms, an `$idPrefix` can be passed along to each template
to make the ids unique.

## Input autofocus

The variable `$autofocusControlId` can be set to the id of the input you want to `autofocus`,
usually the first field with errors.
If no `$idPrefix` is set, this conveniently corresponds to the keys in Laravel's `$errors` bag.
It's best to set it as high up as possible in the view, before any forms are included.
You could even set it in the controller and pass it along to the view.

## Common parameters

All inputs need at least the `$name` parameter
and optional `$placeholder` and `$ariaDescribedById` parameters.

All form views take a `$controlAttributes` `array` that can be used to set any additional html attributes
on the form control element.
This can be useful for setting `required`, `disabled`, `readonly`, `autocomplete`, and other attributes specific to the
[different input types](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#Form_<input>_types).

```php
<form ...>
@include('kontour::forms.input', [
  'name' => 'country_code',
  'controlAttributes' => ['required', 'autocomplete' => 'country', 'size' => '2']
]])
</form>
```

The corresponding parameter to put extra attributes on the label tag is `$labelAttributes`.

## Available input templates

- `textarea` - Pass `$value` to set input contents.
- `input` - Same API as `textarea`, but you can pass `$type` to set the input type (defaults to `text`).
- `select` - Pass `$options` as an `array` of key-values and an optional `$selected` `string` and `$disabledOptions` `array`.
- `radiobuttons` - Same API as `select` for printing radiobuttons instead.
- `multiselect` - Same API as `select` but optional `$selected` `array` instead of `string`.
- `checkboxes` - Same API as `multiselect` for printing checkboxes instead.
- `checkbox` - Pass optional `$checked` as `boolean` and `$value` for a `value` attribute other than
  default `1` (or `$checkboxDefaultValue`).
