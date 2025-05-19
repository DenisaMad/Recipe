# Recipe

1. Enunțul temei:
Proiectul reprezintă un sistem web pentru gestionarea rețetelor de gătit, având următoarele funcționalități:
•	Vizualizarea tuturor rețetelor adăugate.
•	Adăugarea, editarea și ștergerea rețetelor.
•	Gestionarea rețetelor favorite.
•	Interfață prietenoasă și animată cu utilizarea framework-ului Bootstrap și a bibliotecii AOS pentru animații.

2. Structura bazei de date:
Baza de date folosește un tabel principal numit recipes pentru stocarea informațiilor despre rețete.
Structura tabelului recipes:
•	id (INT, AUTO_INCREMENT, PRIMARY KEY) – Identificatorul unic al fiecărei rețete.
•	title (VARCHAR(255)) – Titlul rețetei.
•	ingredients (TEXT) – Ingrediente necesare pentru rețetă.
•	instructions (TEXT) – Instrucțiuni pentru prepararea rețetei.
•	prep_time (INT) – Timpul de preparare în minute.
•	cook_time (INT) – Timpul de gătire în minute.
•	servings (INT) – Numărul de porții.
•	image_url (VARCHAR(255)) – URL-ul imaginii rețetei.
•	created_at (TIMESTAMP) – Data și ora când a fost adăugată rețeta.

3. Explicații de realizare:
•	Backend: Se folosește PHP pentru gestionarea cererilor HTTP și interacțiunea cu baza de date MySQL. Utilizăm PDO pentru a preveni atacurile de tip SQL injection.
•	Frontend: Interfața este realizată cu HTML și CSS, folosind framework-ul Bootstrap pentru responsive design și AOS pentru animații.
•	Funcționalități cheie:
o	CRUD pentru gestionarea rețetelor: Adăugare, editare, ștergere.
o	Favoritul rețetelor este gestionat printr-o sesiune PHP, iar utilizatorii pot marca rețetele ca favorite.


4. Manualul de utilizare:
1.	Adăugarea unei rețete:
o	Navighează la pagina "Add Recipe".
o	Completează câmpurile obligatorii: titlu, ingrediente, instrucțiuni.
o	Opțional, adaugă o imagine și specifică timpul de preparare, gătire și numărul de porții.
o	Apasă pe "Add Recipe" pentru a salva rețeta.
2.	Vizualizarea rețetelor:
o	Toate rețetele disponibile sunt listate pe pagina principală.
o	Poți căuta rețetele după titlu folosind bara de căutare.
o	Poți vedea detalii despre fiecare rețetă, inclusiv ingrediente și instrucțiuni.
3.	Favoritele:
o	Poți marca rețetele ca favorite apăsând pe inima din colțul din dreapta sus.
o	Favoritele tale vor fi vizibile pe pagina "Favorites".
4.	Editarea unei rețete:
o	Accesează rețeta dorită și apasă pe butonul "Edit".
o	Modifică detaliile și apasă pe "Update Recipe" pentru a salva modificările.
5.	Ștergerea unei rețete:
o	Apasă pe butonul "Delete" din pagina de vizualizare a rețetei.
o	Confirma ștergerea în fereastra pop-up.

