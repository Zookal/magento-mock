
I've disabled Mage_Cms!
-----------------------

The catalog system and other routes will still work but you cannot access the root page (/) because that route is provided by Mage_Cms. You only have two solutions:

1. Customize your theme in that way that no one can access (/).
2. Create your own front router by adding an observer to the event `controller_front_init_routers`.

Blocks are also gone.
