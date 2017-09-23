# Once upon a time ...

* Symfony mit CLI

`composer create-project "symfony/skeleton:^3.3" nevercodealon-demo-app`
`composer require cli`

* `\App\Controller\DefaultController` mit `indexAction` anlegen -> routes eintrag ändern, Response nur mit `new Response`
* `extends Controller` `$this->render()` -> Fehler
`composer req twig`

* Einfach tun was man uns sagt
* * TwigBundle wurde installiert
* * Template anlegen in `templates/default/index.html.twig`

Additional:

* Folder Struktur
* * `config/` ordner statt alles in `app/config`, separiert nach bundles
* * `public/` statt `web/`
* * `templates/` statt in `Resources/views`

Es hat sich ein wenig verändert in Symfony

# More Sites

* easy, Symfony ist ein MVC, Routing macht Spass, also {Task für Publikum}
* Anlegen: Seite, die einen speziellen Artikel skizzieren soll
* `ArticleController` angelegt
* `indexAction` mit Parameter `articleName`, der einem Template überreicht wird
* Route angelegt, sollte Parameter enthalten



# Dynamisches Routing

`composer req jackalope/jackalope-doctrine-dbal`
`composer req doctrine/doctrine-cache-bundle`
`composer req doctrine/phpcr-odm`

Config:

```yaml
# into doctrine.yaml
# for jackalope-doctrine-dbal
doctrine:
    dbal:
        driver:   '%env(DATABASE_DRIVER)%'
        path:     '%env(DATABASE_PATH)%'
        charset:  UTF8

# cmf configuration
doctrine_phpcr:
    # configure the PHPCR session
    session:
        backend:
             type: doctrinedbal
             connection: default
             caches:
                 meta: doctrine_cache.providers.phpcr_meta
                 nodes: doctrine_cache.providers.phpcr_nodes
             parameters:
                 jackalope.check_login_on_server: false
        workspace: '%env(PHPCR_WORKSPACE)%'
        username: '%env(PHPCR_USER)%'
        password: '%env(PHPCR_PASSWORD)%'
    # enable the ODM layer
    odm:
        auto_mapping: true
        auto_generate_proxy_classes: true

doctrine_cache:
    providers:
        phpcr_meta:
            type: file_system
        phpcr_nodes:
            type: file_system
```
`composer req doctrine/phpcr-bundle`
`composer req doctrine/doctrine-bundle`

- Init database and its repository

```yaml
  bin/console doctrine:database:create
  bin/console doctrine:phpcr:init:dbal --force
  bin/console doctrine:phpcr:workspace:create default
  bin/console doctrine:phpcr:repository:init
```

- Install routing

`composer req asset`
`composer req validator`
`composer req symfony/templating`
`composer req symfony-cmf/routing-bundle`

- Zum richtig los legen und skizzieren

`composer req doctrine/data-fixtures`

- erstelle `App\AppBundle` (symfony 4 ist Bundle-Less, oder hat es zum Ziel) und trage es in `bundles.php` ein

- erstelle erste Route im Fixture-Loader (was ist ein Fixture-Loader)
- - Nutze `NodeHelper` zum generieren eines eigenen Pfades – schließlich wollen wirs ja in einem Repo 
ablegen
- - Hole root Route und erstelle Route mit ihr als parent und defaults auf neuen Controller

# Content

`composer req security`
`composer req symfony-cmf/content-bundle`

- In `cmf_content.yaml`

```yaml
cmf_content:
    persistence:
        phpcr: ~
```

- erstelle root node für content wie beim Routing
- erstelle `StaticContent` mit name, title, body, und parentDocument
- `doctrine:phpcr:node:dump` -> man siehts
- Noch kein Bezug zur Route? Wie stellen wir das an?
- Erst mal die Erstellung der Route zum Content holen
- Zusammenführen durch `$route->setContent()`
- Alles was zum  `DynamicRoutingController` führte kann jetzt weg
- `doctrine:phpcr:node:dump` -> man sieht? Nö noch nicht
- `doctrine:phpcr:node:dump --props` nun wirds klar
- URL aufrufen
- template anlegen
- geht dann 

# Translatable

`composer req symfony-cmf/core-bundle`
```yaml
cmf_core:
    multilang:
        locales: [en,de]
lunetics_locale:
    strict_mode: true
    guessing_order:
        - router
        - cookie
        - browser
    allowed_locales: [en,de]
```
`composer req lunetics/locale-bundle`
- zu `doctrine_phpcr.odm`:
```yaml
        locales:
            en: [de]
            de: [en]
```
- content + routing + bind Translation
- load fixtures
- see nodes

# Struktur

`composer require symfony-cmf/menu-bundle`
- configuration
```yaml
cmf_menu:
    persistence:
        phpcr:
            menu_basepath: /cms/menu
    voters:
        uri_prefix: true

knp_menu:
    twig: true
```
- use `base.html.twig` everywhere
- `{{ knp_menu_render('main', {'depth': 1}) }}`


# Admin - Ein Vorschlag

- repositories laden
`composer require symfony-cmf/sonata-phpcr-admin-integration-bundle`
`composer require jms/serializer-bundle:^1.0`
- Routing:
```yaml
admin_wo_locale:
    path: /admin
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin_dashboard_wo_locale:
    path: /admin/dashboard
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin_dashboard:
    path: /{_locale}/admin/
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin:
    resource: '@SonataAdminBundle/Resources/config/routing/sonata_admin.xml'
    prefix: /{_locale}/admin

sonata_admin:
    resource: .
    type: sonata_admin
    prefix: /{_locale}/admin

cmf_resource:
    resource: '@CmfResourceRestBundle/Resources/config/routing.yml'
    prefix: /admin

sonata_phpcr_admin_tree:
    resource: '@SonataDoctrinePHPCRAdminBundle/Resources/config/routing/tree.xml'
    prefix: /admin
admin_wo_locale:
    path: /admin
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin_dashboard_wo_locale:
    path: /admin/dashboard
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin_dashboard:
    path: /{_locale}/admin/
    defaults:
        _controller: FrameworkBundle:Redirect:redirect
        route: sonata_admin_dashboard
        permanent: true # this for 301

admin:
    resource: '@SonataAdminBundle/Resources/config/routing/sonata_admin.xml'
    prefix: /{_locale}/admin

sonata_admin:
    resource: .
    type: sonata_admin
    prefix: /{_locale}/admin

cmf_resource:
    resource: '@CmfResourceRestBundle/Resources/config/routing.yml'
    prefix: /admin

sonata_phpcr_admin_tree:
    resource: '@SonataDoctrinePHPCRAdminBundle/Resources/config/routing/tree.xml'
    prefix: /admin

login:
    path: /login
    defaults:
        _controller: 'App\Controller\SecurityController::loginAction'

logout:
    path: /login
    defaults:
        _controller: 'App\Controller\SecurityController::logoutAction'
```
- Routing dev:
```yaml
_wdt:
    resource: '@WebProfilerBundle/Resources/config/routing/wdt.xml'
    prefix:   /_wdt

_profiler:
    resource: '@WebProfilerBundle/Resources/config/routing/profiler.xml'
    prefix:   /_profiler
```
- `composer req web-profiler-bundle` optional mit diesem Routing
- configuration step by step:
```yaml

cmf_resource:
    description:
        enhancers: [sonata_phpcr_admin, cmf_tree_icons, doctrine_phpcr_position]
    repositories:
        default:
            type: doctrine/phpcr-odm

cmf_tree_browser:
    icons:
        AppBundle\Document\DemoSeoContent: 'fa fa-file-text-o'
        Sonata\BlockBundle\Model\BlockInterface: 'fa fa-cube'
        Symfony\Cmf\Bundle\SeoBundle\Model\SeoMetadata: 'fa fa-search'
        Symfony\Cmf\Bundle\MenuBundle\Model\MenuNode: 'fa fa-share-square-o'
        Symfony\Cmf\Bundle\RoutingBundle\Model\Route: 'fa fa-link'
        Symfony\Cmf\Bundle\RoutingBundle\Model\RedirectRoute: 'fa fa-reply'

cmf_sonata_phpcr_admin_integration:
    bundles:
        menu: ~
        core: ~
        content:
           ivory_ckeditor:
              config_name: cmf_sonata_phpcr_admin_integration
        routing: ~

sonata_block:
    default_contexts: [cms]
    blocks:
        sonata.admin.block.admin_list:
            contexts:   [admin]
        sonata.admin.block.search_result:
            contexts:   [admin]
        sonata_admin_doctrine_phpcr.tree_block:
            settings:
                id: '/cms'
            contexts:   [admin]
    blocks_by_class:
        Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\RssBlock:
            cache: cmf.block.cache.js_async

sonata_admin:
    extensions:
        cmf_sonata_phpcr_admin_integration.core.extension.child:
            implements:
                - Symfony\Cmf\Bundle\CoreBundle\Model\ChildInterface
        cmf_sonata_phpcr_admin_integration.core.extension.publish_workflow.time_period:
            implements:
                - Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface
        cmf_sonata_phpcr_admin_integration.core.extension.publish_workflow.publishable:
            implements:
                - Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface
        cmf_sonata_phpcr_admin_integration.menu.extension.menu_node_referrers:
            implements:
                - Symfony\Cmf\Bundle\MenuBundle\Model\MenuNodeReferrersInterface
        cmf_sonata_phpcr_admin_integration.menu.extension.menu_options:
            implements:
                - Symfony\Cmf\Bundle\MenuBundle\Model\MenuOptionsInterface
        cmf_sonata_phpcr_admin_integration.routing.extension.route_referrers:
            implements:
                - Symfony\Cmf\Component\Routing\RouteReferrersInterface
        cmf_sonata_phpcr_admin_integration.routing.extension.frontend_link:
            implements:
                - Symfony\Cmf\Component\Routing\RouteReferrersReadInterface
            extends:
                - Symfony\Component\Routing\Route

    templates:
        layout:     admin/custom_layout.html.twig
        user_block: admin/user_block.html.twig
    dashboard:
        blocks:
            - { position: right, type: sonata.admin.block.admin_list }
            - { position: left, type: sonata_admin_doctrine_phpcr.tree_block }
        groups:
            content:
                label: Content
                icon: '<i class="fa fa-file-text-o"></i>'
                items:
                    - cmf_sonata_phpcr_admin_integration.content.admin
            routing:
                label: URLs
                icon: '<i class="fa fa-link"></i>'
                items:
                    - cmf_sonata_phpcr_admin_integration.routing.route_admin
            menu:
                label: Menu
                icon: '<i class="fa  fa-bars"></i>'
                items:
                    - cmf_sonata_phpcr_admin_integration.menu.menu_admin
                    - cmf_sonata_phpcr_admin_integration.menu.node_admin

sonata_doctrine_phpcr_admin:
    templates:
        form:
            - admin/form_admin_fields.html.twig
    document_tree:
        routing_defaults: [locale]

```
- admin Templates aus der Sandbox kopiert
- security Templates aus der Sandbox kopiert
- SecurityController angelegt -> login/logout
- routen für Security angelegt:
```yaml
login:
    path: /login
    defaults:
        _controller: 'App\Controller\SecurityController::loginAction'

logout:
    path: /login
    defaults:
        _controller: 'App\Controller\SecurityController::logoutAction'
```
- session in framwork configuration an:
```yaml
    session:
        name: symfony-cmf
```
- ResourceVoter aus Sandbox verwendet und registriert
- security.yaml aus Sandbox verwendet
- `bin/console assets:install` nicht vergessen

# SEO

`composer require symfony-cmf/seo-bundle`
- configuration
```yaml
cmf_seo:
    persistence:
        phpcr: ~
    title: Never Code Alone | %%content_title%%
    description: The Content Management Framework. %%content_description%%
    alternate_locale: ~

sonata_seo:
    page:
        title: Never Code Alone
        metas:
            name:
                keywords: "CMF, Symfony, Routing, Content, PHPCR"

```
- extension in sonata admin configuration

```yaml
        cmf_sonata_phpcr_admin_integration.seo.extension.metadata:
            implements:
                - Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface
```
- activate seo in integration
- Lege `DemoSeoContent` and wie in Sandbox
- Compiler Pass wie in Sandbox um den Admin zu tweaken
- Im Content Loading dazu bauen




