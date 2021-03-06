# Code Kata for Fractions

The idea of this code kata is to show separation of concerns in particular and other aspects
like how to use code coverage tools like JaCoCo as well as Mutation Testing to support the development
process.

This Kata defines the domain of working in a very simple domain which is basic school mathematics as
given with fractions.

# Requirement Definition I

## Overview

We would like to calculate fraction operations which are defined in a file line by line.

## File Format

The file can contain comment lines which are identified
by `#` at the beginning of the line and have to be ignored.

## Fraction Format

A fraction starts by `{` and limited by `}`. The numerator separated by `/` from the denominator.
The numerator as well as the denominator are integer values which can be prefixed by a `-` to define
a negative fraction.

- `{9/12}` This would define the fraction `9/12`.
- `{-9/12}` This would define the fraction `-9/12`.
- `{9/-12}` This would define the fraction `9/-12`.

## Definition of the valid operations

We define the following operations as valid on fractions:

- `+` addition
- `-` subtraction
- `*` multiplication
- `/` divide

We need to be able to add, subtract, divide, multiply or create the power of a fraction.

## Example for test

- The following gives an example how to add two fractions: `{3/2}+{4/4}`
- The following gives an example how to subtract two fractions: `{3/2}-{4/4}`
- The following gives an example how to multiply two fractions: `{3/2}*{4/4}`
- The following gives an example how to divide two fractions: `{3/2}/{4/4}`

## Example Lines

The following is an example of a line of operations on fractions:

```
{3/2}+{4/4}/{2/3}
```

and it should be handled to calculate the results of those
fraction operations.

Expected output `3`.

👁️ It's important that if the command does contain parenthesis we have to
prioritize the operations and if it doesn't we have to prioritize by operations.

How would this be resolved

```
{3/2}+{4/4}/{2/3}
```

**First step**

```
{4/4}/{2/3}
```

**Second step**

```
{3/2}+RESULT_FROM_FIRST_OPERATION
```

## Other example

```
({3/2}+{4/4})/{2/3}
```

**First step**

```
({3/2}+{4/4})
```

**Second step**

```
RESULT_FROM_FIRST_OPERATION/{1/2}
```

# Requirement Definition II

The change vs I.

Introduce parenthesis like this:

```
( {3/2}+{4/4} )/{2/3}
```

# Requirement Definition III

The change vs I

Integer => Long => BigInteger ?

# Possible regex

(?:[1-9][0-9]_|0)(?:\/[1-9][0-9]_)?
