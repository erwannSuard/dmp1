
CREATE TABLE contact (
id_contact INTEGER NOT NULL PRIMARY KEY, 
type_contact TEXT NOT NULL, 
last_name TEXT NOT NULL, 
first_name TEXT,
mail TEXT NOT NULL,
affiliation TEXT NOT NULL,
identifier TEXT,
CHECK(type_contact IN ('Organization', 'Person'))
);

CREATE TABLE funding (
id_funding INTEGER NOT NULL PRIMARY KEY,
grant_funding INTEGER NOT NULL,
id_contact_funding INTEGER NOT NULL,
FOREIGN KEY (id_contact_funding) REFERENCES contact(id_contact)
);

CREATE TABLE project (
id_project INTEGER NOT NULL PRIMARY KEY,
title TEXT NOT NULL,
abstract TEXT NOT NULL,
acronyme TEXT NOT NULL,
start_date DATE NOT NULL,
duration INTEGER,
type TEXT NOT NULL,
website TEXT,
objectives TEXT NOT NULL,
id_ref_project INTEGER,
id_funding_project INTEGER NOT NULL,
FOREIGN KEY (id_ref_project) REFERENCES project(id_project),
FOREIGN KEY (id_funding_project) REFERENCES funding(id_funding)
);

CREATE TABLE romp (
id_romp INTEGER NOT NULL PRIMARY KEY,
identifier TEXT,
submission_date DATE NOT NULL,
version TEXT NOT NULL,
deliverable TEXT NOT NULL,
licence TEXT DEFAULT 'CC-BY-4.0',
id_project_romp INTEGER NOT NULL,
id_contact_romp INTEGER NOT NULL,
FOREIGN KEY (id_project_romp) REFERENCES project(id_project),
FOREIGN KEY (id_contact_romp) REFERENCES contact(id_contact),
CHECK(licence IN ('CC-BY-4.0', 'CC-BY-NC-4.0', 'CC-BY--ND-4.0', 'CC-BY--SA-4.0', 'CC0-1.0'))
);

CREATE TABLE contact_project (
id_contact INTEGER NOT NULL,
id_project INTEGER NOT NULL,
PRIMARY KEY (id_contact, id_project),
FOREIGN KEY (id_contact) REFERENCES contact(id_contact),
FOREIGN KEY (id_project) REFERENCES project(id_project)
);



