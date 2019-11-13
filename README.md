# wp-illdy-clone
# Sujet Illdy
## Général
- Le thème illdy-child doit être un thème enfant de Blankslate (https://fr.wordpress.org/themes/blankslate/)
- Plugins utiles : What The File (pour voir quel(s) template(s) sont utilisés), Theme Check, Advanced Custom Fields (pour ajouter des champs à un type de contenu sans avoir à coder des metafields)
## Header
- Le menu doit être dynamique (7 éléments) ✔
- Le titre et le sous-titre doivent être dynamiques. ✔
- Les boutons pointent vers une même page statique "Learn More" (pas besoin de rendre ça éditable) ✔
## Section "About"
- Garder en statique pour l'instant ✔
## Section "Projects"
- Affiche les 4 derniers items d'un custom post type "projects" (-> un menu "Projects" doit être créé dans le backoffice) ✔
- Chaque projet contient juste un nom, une image et un lien externe. ✔
## Section "Testimonials"
- Affiche les 4 derniers items d'un custom post type "testimonials" (-> un menu "Testimonials" doit être créé dans le backoffice)
## Section "Services"
- Garder en statique ✔
## Latest News
- Texte + bouton en statique, montrer les 3 derniers articles
## Stats + Team
- Laisser en statique pour l'instant ✔
## Contact Us
- Utiliser le plugin "Contact forms 7"
- Au moment de l'envoi du mail, stocker en BDD une copie du nom/mail/sujet/message
## Footer
- Faire un menu "footer" dans le backoffice
- Ne gérer en dynamique que la 1ère colonne (2e et 3e en statique, et on verra plus tard pour passer ça en sidebar)
