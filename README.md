# DigitalPianism EasyToplinks

A small module that provides top links management layout actions.

## Features

### Change position of a top link via layout XML

Instead of having to remove then re-add the top link.

```
<reference name="top.links">
        <action method="setPosition">
        <url helper="customer/getLoginUrl"/>
        <position>1</position>
    </action>
</reference>
```

The new `setPosition` method takes two parameters:

 * URL of the top link
 * New position of the top link

### Rename label and title of a top link via layout XML

Instead of having to remove then re-add the top link.

```
<reference name="top.links">
    <action method="rename">
        <url helper="customer/getLoginUrl"/>
        <name>Log In</name>
    </action>
</reference>
```

The new `rename` method takes two parameters:

 * URL of the top link
 * New name of the link

N.B.: with this method, both the label and the title of the top link will be renamed.