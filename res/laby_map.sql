COPY public.maps (mapid, z, theme) FROM stdin;
1	1	BLUE
2	2	BLUE
3	3	BRICK
\.

SELECT pg_catalog.setval('public.maps_mapid_seq', 3, true);

