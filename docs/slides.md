### Extending a Symfony Application by CMS features
#### Maximilian Berghoff - 23.09.2017 - Never Code Alone

Note: ... 

---

<span class="title-container">![Title-Pic](docs/images/title_picture.jpg)</span>

- Maximilian Berghoff <!-- .element: class="fragment" -->
- @ElectricMaxxx <!-- .element: class="fragment" -->
- github.com/electricmaxxx <!-- .element: class="fragment" -->
- Maximilian.Berghoff@mayflower.de <!-- .element: class="fragment" -->
- Mayflower GmbH - Würzburg <!-- .element: class="fragment" -->

Note: That's me. This foto is a part of my internet live since almost 5 years. Cause 
      it is from his first birthday. So when not writing OSS libraries i am a husband and dad.
      You can contact me: 
      ... KLICK ... Twitter ... KLICK ... follow my Github account ... KLICK ... or simply
      writing an Email ... KLICK ... As you can see at my mail address ... KLICK ... I work
      for Mayflower in Würzburg. We a
      ... KLICK
      So lets start ... a little story

---

---

# Once upon a time ...
## Symfony Application <!-- .element: class="fragment" -->

Note: Wir fangen einfach einmal mit einer netten kleinen Symfony App
      - Wer arbeitet öfters an Symfony -> Wieviel erklären
      - Wir haben ja noch keine, na dann bauen wir eben eine und stellen uns vor, dass wäre eine riesen App

---

# Coding

Note: ... Coding...
      - Wie nun weiter?
      - Gesehen: Routen anlegen geht ja recht fix in Symfony. 
      - Doch dynamisch?
      - Pattern sind schön und gut, doch irgendwann kommt man an einen Punkt wo es nicht mehr langt, wie wäre es dann
      mit (KLICK) dynamischen Routing?
----

# Dynamic Routing

Note: ... Was ist das überhaupt dynamisches Routing?
      - haben gesehen: statisch Routing, schnell weil in Symfony gecached. Löst schnell Routen auf und ruft den 
      - doch was bei: vielen Routen? editierbaren Routen? (zumindest beim create) Und was bei richtig vielen Routen?
      - (BACK)
      - Kann man sich nun vorstellen, wie man sich nun einfaches Routing dynamisch aufzieht?
      - Im Grunde erst einmal nur ein Mapping zwischen Route (URL) und einem Controller
      - Netter Admin dazu und fertig ist das Routing
      - Doch meist will man ja mehr ... (KLICK) ...

--- 

# Content

Note: Wir wollen mit einer URL gleichzeitig Content ausspielen. Das heißt unser Content braucht eine 
      Referenz auf die Route (und nicht umgekehrt) und bei einem match der Route muss der Content irgendwie angezeigt werden.
      - Na dann mal los ... 
      - Geht gut oder?
      - Wir sollten uns jetzt nur einmal vorstellen, dass wir jetzt einen netten Admin dazu bauen,
      schön mit WYSIWYG und ner Eingabe fürs Routing und schon haben wir unser erstes kleines CMS
      - Nun leben wir einmal auch in einer globalen Welt, also brauchen wir auch ...
      
---

# Translateable Content

Note: Content sollte in mehren Sprachen vorliegen. Doch wie legt man die verschiedenen Repräsentationen ab?
      - Genau in dem Baum
      - Dann tun wir es.
      - Ich finde das war einfach, oder?
      - Content lebt jetzt in seiner jeweiligen Repräsentation im Repository
      - Wir werden später mit einem Admin sehen, wie einfach es dann sein wird zwischen den Sprachen zu wechseln
      - Doch vorher wollen wir ein wenig ... (KLICK) ...
      
---

# Sturcture

Note: ... Struktur rein bringen
      - Was ist Struktur?
      - Ein Menü bietet dem Nutzer eine Struktur an um sich geführt im Content zurecht zu finden.
      - Ein Menü ist auch wieder hierarchisch strukturiert, also wie geschaffen um es in einer Baum
      artigen Struktur wie dem PHPCR abzulegen
      - Jetzt sind wir doch schon einen riesen Schritt witer
      - Wir haben:
      - - Routen, die wir editieren könnten
      - - Content, den wir editieren könnten
      - - Menu, das wir editiernen könnten
      - Was uns da noch fehlt: Eine möglichkeit zum Editieren
      - ... (KLICK) ...
      
---
      
# (Sonata) Admin

Note: Das ist nur erst mal ein Vorschlag, man kann den Admin selber aufsetzen oder ganz und gar per REST
      drauf gehen
      - bieten Integration für Sonata
      - Für CRUD und für Prototyping recht cool
      - Wird halt anstrengend wenn man vom Weg abkommt
      - Maintainen Implementierung für PHPCR
      - ... Los gehts  ... (KLick) ....
      - So nun sehen wir auch was wir tun, und müssen nicht alles mit den DataFixtures tun
      - Ein Thema wäre noch nett: 
      - .... (KLICK) ...
      
---

# SEO

Note: Ich bin jetzt kein großer Fan von "Websites wie Google wünscht"
      - aber mit ein paar Kniffen kann man basics übermitteln,
      - wenn dann noch der Content gut ist :-)
      - Dann mal ab zum letzten Block ... (CODE)

---

# Conclusion

Note: Noch lange nicht alles, wichtig Baum, dann noch Resourcen, Block, ...

---

# Questions?

- Ask Now!
- Twitter: @ElectricMaxxx <!-- .element: class="fragment" -->
- Mail: Maximilian.Berghoff@mayflower.de <!-- .element: class="fragment" -->

---

# Links
* [Website](http://cmf.symfony.com/)
* [Documentation](http://symfony.com/doc/master/cmf/index.html)
* [Mailinglist](http://groups.google.com/group/symfony-cmf-devs)
* [IRC](irc://freenode/#symfony-cmf)
* [Sandbox](http://sandbox.cmf.symfony.com)
* [Code Examples mentioned here](https://github.com/ElectricMaxxx/ipc-cmf-example-application)

---

# Thank You!

