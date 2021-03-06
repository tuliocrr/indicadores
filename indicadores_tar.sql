toc.dat                                                                                             0000600 0004000 0002000 00000072337 12651711120 014447  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        PGDMP       ,    #                 t           indicadores    9.4.4    9.4.4 o    q	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false         r	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false         s	           1262    22883    indicadores    DATABASE     i   CREATE DATABASE indicadores WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';
    DROP DATABASE indicadores;
             postgres    false                     2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false         t	           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    6         u	           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    6         �            3079    12123    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false         v	           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    198         �            1255    22884    sem_acento(character varying)    FUNCTION       CREATE FUNCTION sem_acento(character varying) RETURNS character varying
    LANGUAGE sql
    AS $_$
SELECT TRANSLATE($1, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$_$;
 4   DROP FUNCTION public.sem_acento(character varying);
       public       postgres    false    6         �            1259    23037    cargos    TABLE     �   CREATE TABLE cargos (
    id integer NOT NULL,
    titulo character varying(100),
    conta_id integer,
    descricao character varying(255),
    status integer DEFAULT 1
);
    DROP TABLE public.cargos;
       public         postgres    false    6         �            1259    23035    cargos_id_seq    SEQUENCE     o   CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cargos_id_seq;
       public       postgres    false    6    193         w	           0    0    cargos_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE cargos_id_seq OWNED BY cargos.id;
            public       postgres    false    192         �            1259    22967    contas    TABLE     l   CREATE TABLE contas (
    id integer NOT NULL,
    titulo character varying(255),
    usuario_id integer
);
    DROP TABLE public.contas;
       public         postgres    false    6         �            1259    22965    contas_id_seq    SEQUENCE     o   CREATE SEQUENCE contas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.contas_id_seq;
       public       postgres    false    185    6         x	           0    0    contas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE contas_id_seq OWNED BY contas.id;
            public       postgres    false    184         �            1259    22885    departamentos    TABLE     �   CREATE TABLE departamentos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
 !   DROP TABLE public.departamentos;
       public         postgres    false    6         �            1259    22889    departamentos_id_seq    SEQUENCE     v   CREATE SEQUENCE departamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.departamentos_id_seq;
       public       postgres    false    6    172         y	           0    0    departamentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE departamentos_id_seq OWNED BY departamentos.id;
            public       postgres    false    173         �            1259    23051 	   dimensoes    TABLE     �   CREATE TABLE dimensoes (
    id integer NOT NULL,
    titulo character varying(200),
    ano character varying(4),
    conta_id integer,
    status integer DEFAULT 1
);
    DROP TABLE public.dimensoes;
       public         postgres    false    6         �            1259    23049    dimensoes_id_seq    SEQUENCE     r   CREATE SEQUENCE dimensoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.dimensoes_id_seq;
       public       postgres    false    195    6         z	           0    0    dimensoes_id_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE dimensoes_id_seq OWNED BY dimensoes.id;
            public       postgres    false    194         �            1259    22999    faixas    TABLE     �   CREATE TABLE faixas (
    id integer NOT NULL,
    titulo character varying(100),
    limite_vermelho numeric(10,2),
    limite_amarelo numeric(10,2),
    status integer,
    conta_id integer
);
    DROP TABLE public.faixas;
       public         postgres    false    6         �            1259    22997    faixas_id_seq    SEQUENCE     o   CREATE SEQUENCE faixas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.faixas_id_seq;
       public       postgres    false    189    6         {	           0    0    faixas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE faixas_id_seq OWNED BY faixas.id;
            public       postgres    false    188         �            1259    23012    indicadores    TABLE     �   CREATE TABLE indicadores (
    id integer NOT NULL,
    titulo character varying(255),
    conta_id integer,
    faixa_id integer
);
    DROP TABLE public.indicadores;
       public         postgres    false    6         �            1259    23010    indicadores_id_seq    SEQUENCE     t   CREATE SEQUENCE indicadores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.indicadores_id_seq;
       public       postgres    false    191    6         |	           0    0    indicadores_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE indicadores_id_seq OWNED BY indicadores.id;
            public       postgres    false    190         �            1259    22891    perfis    TABLE     �   CREATE TABLE perfis (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    created timestamp without time zone,
    modified timestamp without time zone,
    conta_id integer
);
    DROP TABLE public.perfis;
       public         postgres    false    6         �            1259    22895    perfis_id_seq    SEQUENCE     o   CREATE SEQUENCE perfis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.perfis_id_seq;
       public       postgres    false    174    6         }	           0    0    perfis_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE perfis_id_seq OWNED BY perfis.id;
            public       postgres    false    175         �            1259    22897 
   permissoes    TABLE     r   CREATE TABLE permissoes (
    id integer NOT NULL,
    perfil_id integer,
    descricao character varying(255)
);
    DROP TABLE public.permissoes;
       public         postgres    false    6         �            1259    22900    permissoes_id_seq    SEQUENCE     s   CREATE SEQUENCE permissoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.permissoes_id_seq;
       public       postgres    false    6    176         ~	           0    0    permissoes_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE permissoes_id_seq OWNED BY permissoes.id;
            public       postgres    false    177         �            1259    22902    pessoas    TABLE     �   CREATE TABLE pessoas (
    id integer NOT NULL,
    nome character varying(255),
    email character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1
);
    DROP TABLE public.pessoas;
       public         postgres    false    6         �            1259    22909    pessoas_id_seq    SEQUENCE     p   CREATE SEQUENCE pessoas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.pessoas_id_seq;
       public       postgres    false    178    6         	           0    0    pessoas_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE pessoas_id_seq OWNED BY pessoas.id;
            public       postgres    false    179         �            1259    23077    procedimentos    TABLE     M  CREATE TABLE procedimentos (
    id integer NOT NULL,
    titulo character varying(255),
    resultado_esperado text,
    passo text,
    requisito text,
    arquivo character varying(255),
    arquivo_dir character varying(255),
    usuario_id integer,
    certificado integer,
    conta_id integer,
    status integer DEFAULT 1
);
 !   DROP TABLE public.procedimentos;
       public         postgres    false    6         �            1259    23075    procedimentos_id_seq    SEQUENCE     v   CREATE SEQUENCE procedimentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.procedimentos_id_seq;
       public       postgres    false    197    6         �	           0    0    procedimentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE procedimentos_id_seq OWNED BY procedimentos.id;
            public       postgres    false    196         �            1259    22911    regras    TABLE     q   CREATE TABLE regras (
    id integer NOT NULL,
    permissao_id integer,
    descricao character varying(255)
);
    DROP TABLE public.regras;
       public         postgres    false    6         �            1259    22914    regras_id_seq    SEQUENCE     o   CREATE SEQUENCE regras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.regras_id_seq;
       public       postgres    false    180    6         �	           0    0    regras_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE regras_id_seq OWNED BY regras.id;
            public       postgres    false    181         �            1259    22916    usuarios    TABLE     `  CREATE TABLE usuarios (
    id integer NOT NULL,
    login character varying(255),
    senha character varying(32),
    pessoa_id integer,
    perfil_id integer,
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1,
    departamento_id integer,
    conta_id integer,
    vinculo_id integer
);
    DROP TABLE public.usuarios;
       public         postgres    false    6         �            1259    22920    usuarios_id_seq    SEQUENCE     q   CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public       postgres    false    6    182         �	           0    0    usuarios_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;
            public       postgres    false    183         �            1259    22980    vinculos    TABLE     �   CREATE TABLE vinculos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
    DROP TABLE public.vinculos;
       public         postgres    false    6         �            1259    22978    vinculos_id_seq    SEQUENCE     q   CREATE SEQUENCE vinculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.vinculos_id_seq;
       public       postgres    false    6    187         �	           0    0    vinculos_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE vinculos_id_seq OWNED BY vinculos.id;
            public       postgres    false    186         �           2604    23040    id    DEFAULT     X   ALTER TABLE ONLY cargos ALTER COLUMN id SET DEFAULT nextval('cargos_id_seq'::regclass);
 8   ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    193    192    193         �           2604    22970    id    DEFAULT     X   ALTER TABLE ONLY contas ALTER COLUMN id SET DEFAULT nextval('contas_id_seq'::regclass);
 8   ALTER TABLE public.contas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    185    184    185         �           2604    22922    id    DEFAULT     f   ALTER TABLE ONLY departamentos ALTER COLUMN id SET DEFAULT nextval('departamentos_id_seq'::regclass);
 ?   ALTER TABLE public.departamentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    173    172         �           2604    23054    id    DEFAULT     ^   ALTER TABLE ONLY dimensoes ALTER COLUMN id SET DEFAULT nextval('dimensoes_id_seq'::regclass);
 ;   ALTER TABLE public.dimensoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    194    195         �           2604    23002    id    DEFAULT     X   ALTER TABLE ONLY faixas ALTER COLUMN id SET DEFAULT nextval('faixas_id_seq'::regclass);
 8   ALTER TABLE public.faixas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    188    189    189         �           2604    23015    id    DEFAULT     b   ALTER TABLE ONLY indicadores ALTER COLUMN id SET DEFAULT nextval('indicadores_id_seq'::regclass);
 =   ALTER TABLE public.indicadores ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    190    191    191         �           2604    22923    id    DEFAULT     X   ALTER TABLE ONLY perfis ALTER COLUMN id SET DEFAULT nextval('perfis_id_seq'::regclass);
 8   ALTER TABLE public.perfis ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    175    174         �           2604    22924    id    DEFAULT     `   ALTER TABLE ONLY permissoes ALTER COLUMN id SET DEFAULT nextval('permissoes_id_seq'::regclass);
 <   ALTER TABLE public.permissoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    177    176         �           2604    22925    id    DEFAULT     Z   ALTER TABLE ONLY pessoas ALTER COLUMN id SET DEFAULT nextval('pessoas_id_seq'::regclass);
 9   ALTER TABLE public.pessoas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    179    178         �           2604    23080    id    DEFAULT     f   ALTER TABLE ONLY procedimentos ALTER COLUMN id SET DEFAULT nextval('procedimentos_id_seq'::regclass);
 ?   ALTER TABLE public.procedimentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197         �           2604    22926    id    DEFAULT     X   ALTER TABLE ONLY regras ALTER COLUMN id SET DEFAULT nextval('regras_id_seq'::regclass);
 8   ALTER TABLE public.regras ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    181    180         �           2604    22927    id    DEFAULT     \   ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    183    182         �           2604    22983    id    DEFAULT     \   ALTER TABLE ONLY vinculos ALTER COLUMN id SET DEFAULT nextval('vinculos_id_seq'::regclass);
 :   ALTER TABLE public.vinculos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    186    187    187         j	          0    23037    cargos 
   TABLE DATA               B   COPY cargos (id, titulo, conta_id, descricao, status) FROM stdin;
    public       postgres    false    193       2410.dat �	           0    0    cargos_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('cargos_id_seq', 1, false);
            public       postgres    false    192         b	          0    22967    contas 
   TABLE DATA               1   COPY contas (id, titulo, usuario_id) FROM stdin;
    public       postgres    false    185       2402.dat �	           0    0    contas_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('contas_id_seq', 1, false);
            public       postgres    false    184         U	          0    22885    departamentos 
   TABLE DATA               Q   COPY departamentos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    172       2389.dat �	           0    0    departamentos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('departamentos_id_seq', 2, true);
            public       postgres    false    173         l	          0    23051 	   dimensoes 
   TABLE DATA               ?   COPY dimensoes (id, titulo, ano, conta_id, status) FROM stdin;
    public       postgres    false    195       2412.dat �	           0    0    dimensoes_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('dimensoes_id_seq', 1, true);
            public       postgres    false    194         f	          0    22999    faixas 
   TABLE DATA               X   COPY faixas (id, titulo, limite_vermelho, limite_amarelo, status, conta_id) FROM stdin;
    public       postgres    false    189       2406.dat �	           0    0    faixas_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('faixas_id_seq', 1, true);
            public       postgres    false    188         h	          0    23012    indicadores 
   TABLE DATA               >   COPY indicadores (id, titulo, conta_id, faixa_id) FROM stdin;
    public       postgres    false    191       2408.dat �	           0    0    indicadores_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('indicadores_id_seq', 1, false);
            public       postgres    false    190         W	          0    22891    perfis 
   TABLE DATA               J   COPY perfis (id, titulo, status, created, modified, conta_id) FROM stdin;
    public       postgres    false    174       2391.dat �	           0    0    perfis_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('perfis_id_seq', 12, true);
            public       postgres    false    175         Y	          0    22897 
   permissoes 
   TABLE DATA               7   COPY permissoes (id, perfil_id, descricao) FROM stdin;
    public       postgres    false    176       2393.dat �	           0    0    permissoes_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('permissoes_id_seq', 98, true);
            public       postgres    false    177         [	          0    22902    pessoas 
   TABLE DATA               F   COPY pessoas (id, nome, email, created, modified, status) FROM stdin;
    public       postgres    false    178       2395.dat �	           0    0    pessoas_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('pessoas_id_seq', 1, true);
            public       postgres    false    179         n	          0    23077    procedimentos 
   TABLE DATA               �   COPY procedimentos (id, titulo, resultado_esperado, passo, requisito, arquivo, arquivo_dir, usuario_id, certificado, conta_id, status) FROM stdin;
    public       postgres    false    197       2414.dat �	           0    0    procedimentos_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('procedimentos_id_seq', 1, false);
            public       postgres    false    196         ]	          0    22911    regras 
   TABLE DATA               6   COPY regras (id, permissao_id, descricao) FROM stdin;
    public       postgres    false    180       2397.dat �	           0    0    regras_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('regras_id_seq', 196, true);
            public       postgres    false    181         _	          0    22916    usuarios 
   TABLE DATA               �   COPY usuarios (id, login, senha, pessoa_id, perfil_id, created, modified, status, departamento_id, conta_id, vinculo_id) FROM stdin;
    public       postgres    false    182       2399.dat �	           0    0    usuarios_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('usuarios_id_seq', 1, true);
            public       postgres    false    183         d	          0    22980    vinculos 
   TABLE DATA               L   COPY vinculos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    187       2404.dat �	           0    0    vinculos_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('vinculos_id_seq', 1, true);
            public       postgres    false    186         �           2606    23042    cargos_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
       public         postgres    false    193    193         �           2606    22972    contas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_pkey;
       public         postgres    false    185    185         �           2606    22929    departamentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.departamentos DROP CONSTRAINT departamentos_pkey;
       public         postgres    false    172    172         �           2606    23056    dimensoes_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_pkey;
       public         postgres    false    195    195         �           2606    23024    faixas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_pkey;
       public         postgres    false    189    189         �           2606    23017    indicadores_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_pkey;
       public         postgres    false    191    191         �           2606    22931    perfis_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY perfis
    ADD CONSTRAINT perfis_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.perfis DROP CONSTRAINT perfis_pkey;
       public         postgres    false    174    174         �           2606    22933    permissoes_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_pkey;
       public         postgres    false    176    176         �           2606    22935    pessoas_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY pessoas
    ADD CONSTRAINT pessoas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.pessoas DROP CONSTRAINT pessoas_pkey;
       public         postgres    false    178    178         �           2606    23086    procedimentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY procedimentos
    ADD CONSTRAINT procedimentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.procedimentos DROP CONSTRAINT procedimentos_pkey;
       public         postgres    false    197    197         �           2606    22937    regras_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_pkey;
       public         postgres    false    180    180         �           2606    22939    usuarios_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    182    182         �           2606    22986    vinculos_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY vinculos
    ADD CONSTRAINT vinculos_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.vinculos DROP CONSTRAINT vinculos_pkey;
       public         postgres    false    187    187         �           2606    23043    cargos_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_conta_id_fkey;
       public       postgres    false    193    185    2256         �           2606    22973    contas_usuario_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
 G   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_usuario_id_fkey;
       public       postgres    false    2254    185    182         �           2606    23057    dimensoes_conta_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 K   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_conta_id_fkey;
       public       postgres    false    185    195    2256         �           2606    23025    faixas_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_conta_id_fkey;
       public       postgres    false    2256    189    185         �           2606    23018    indicadores_conta_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_conta_id_fkey;
       public       postgres    false    185    2256    191         �           2606    23030    indicadores_faixa_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_faixa_id_fkey FOREIGN KEY (faixa_id) REFERENCES faixas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_faixa_id_fkey;
       public       postgres    false    191    2260    189         �           2606    22940    permissoes_perfil_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 N   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_perfil_id_fkey;
       public       postgres    false    2246    176    174         �           2606    22945    regras_permissao_id_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_permissao_id_fkey FOREIGN KEY (permissao_id) REFERENCES permissoes(id);
 I   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_permissao_id_fkey;
       public       postgres    false    176    180    2248         �           2606    22950    usuarios_departamento_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamentos(id);
 P   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_departamento_id_fkey;
       public       postgres    false    172    182    2244         �           2606    22955    usuarios_perfil_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_perfil_id_fkey;
       public       postgres    false    182    2246    174         �           2606    22960    usuarios_pessoa_id_fkey    FK CONSTRAINT     u   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pessoa_id_fkey FOREIGN KEY (pessoa_id) REFERENCES pessoas(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pessoa_id_fkey;
       public       postgres    false    178    182    2250                                                                                                                                                                                                                                                                                                         2410.dat                                                                                            0000600 0004000 0002000 00000000005 12651711120 014227  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2402.dat                                                                                            0000600 0004000 0002000 00000000005 12651711120 014230  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2389.dat                                                                                            0000600 0004000 0002000 00000000064 12651711120 014253  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Financeiro	1	\N	\N	\N
2	Testes111	0	\N	\N	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                            2412.dat                                                                                            0000600 0004000 0002000 00000000030 12651711120 014227  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	testes	1234	\N	1
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        2406.dat                                                                                            0000600 0004000 0002000 00000000036 12651711120 014240  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	teste	3.00	-3.00	\N	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  2408.dat                                                                                            0000600 0004000 0002000 00000000005 12651711120 014236  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2391.dat                                                                                            0000600 0004000 0002000 00000000201 12651711120 014235  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        2	Gestor	1	\N	\N	\N
12	Funcionario	1	2016-01-12 09:53:08	2016-01-12 09:53:08	\N
1	Administrador	1	\N	2016-01-24 14:51:26	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                               2393.dat                                                                                            0000600 0004000 0002000 00000002025 12651711120 014245  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	12	Usuário.Adicionar
2	12	Usuário.Deletar
3	12	Usuário.Editar
4	12	Usuário.Listagem
5	12	Usuário.Visualizar
59	1	Perfil.Adicionar
60	1	Perfil.Excluir
61	1	Perfil.Editar
62	1	Perfil.Listagem
63	1	Perfil.Visualizar
64	1	Usuário.Adicionar
65	1	Usuário.Excluir
66	1	Usuário.Editar
67	1	Usuário.Listagem
68	1	Usuário.Visualizar
69	1	Cargo.Adicionar
70	1	Cargo.Excluir
71	1	Cargo.Editar
72	1	Cargo.Listagem
73	1	Cargo.Visualizar
74	1	Departamento.Adicionar
75	1	Departamento.Excluir
76	1	Departamento.Editar
77	1	Departamento.Listagem
78	1	Departamento.Visualizar
79	1	Faixa.Adicionar
80	1	Faixa.Excluir
81	1	Faixa.Editar
82	1	Faixa.Listagem
83	1	Faixa.Visualizar
84	1	Vinculo.Adicionar
85	1	Vinculo.Excluir
86	1	Vinculo.Editar
87	1	Vinculo.Listagem
88	1	Vinculo.Visualizar
89	1	Dimensão.Adicionar
90	1	Dimensão.Excluir
91	1	Dimensão.Editar
92	1	Dimensão.Listagem
93	1	Dimensão.Visualizar
94	1	Procedimentos.Adicionar
95	1	Procedimentos.Excluir
96	1	Procedimentos.Editar
97	1	Procedimentos.Listagem
98	1	Procedimentos.Visualizar
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2395.dat                                                                                            0000600 0004000 0002000 00000000061 12651711120 014245  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Tulio Carvalho	tulio@civis.com.br	\N	\N	1
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2414.dat                                                                                            0000600 0004000 0002000 00000000005 12651711120 014233  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        \.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           2397.dat                                                                                            0000600 0004000 0002000 00000005532 12651711120 014257  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	1	Usuarios.adicionar.action
2	1	Usuarios.adicionar.element
3	2	Usuarios.deletar.action
4	2	Usuarios.deletar.element
5	3	Usuarios.editar.action
6	3	Usuarios.editar.element
7	4	Usuarios.index.action
8	4	Usuarios.listar.element
9	5	Usuarios.visualizar.action
10	5	Usuarios.visualizar.element
117	59	Perfis.adicionar.action
118	59	Perfis.adicionar.element
119	60	Perfis.excluir.action
120	60	Perfis.excluir.element
121	61	Perfis.editar.action
122	61	Perfis.editar.element
123	62	Perfis.index.action
124	62	Perfis.listar.element
125	63	Perfis.visualizar.action
126	63	Perfis.visualizar.element
127	64	Usuarios.adicionar.action
128	64	Usuarios.adicionar.element
129	65	Usuarios.excluir.action
130	65	Usuarios.excluir.element
131	66	Usuarios.editar.action
132	66	Usuarios.editar.element
133	67	Usuarios.index.action
134	67	Usuarios.listar.element
135	68	Usuarios.visualizar.action
136	68	Usuarios.visualizar.element
137	69	Cargos.adicionar.action
138	69	Cargos.adicionar.element
139	70	Cargos.excluir.action
140	70	Cargos.excluir.element
141	71	Cargos.editar.action
142	71	Cargos.editar.element
143	72	Cargos.index.action
144	72	Cargos.listar.element
145	73	Cargos.visualizar.action
146	73	Cargos.visualizar.element
147	74	Departamentos.adicionar.action
148	74	Departamentos.adicionar.element
149	75	Departamentos.excluir.action
150	75	Departamentos.excluir.element
151	76	Departamentos.editar.action
152	76	Departamentos.editar.element
153	77	Departamentos.index.action
154	77	Departamentos.listar.element
155	78	Departamentos.visualizar.action
156	78	Departamentos.visualizar.element
157	79	Faixas.adicionar.action
158	79	Faixas.adicionar.element
159	80	Faixas.excluir.action
160	80	Faixas.excluir.element
161	81	Faixas.editar.action
162	81	Faixas.editar.element
163	82	Faixas.index.action
164	82	Faixas.listar.element
165	83	Faixas.visualizar.action
166	83	Faixas.visualizar.element
167	84	Vinculos.adicionar.action
168	84	Vinculos.adicionar.element
169	85	Vinculos.excluir.action
170	85	Vinculos.excluir.element
171	86	Vinculos.editar.action
172	86	Vinculos.editar.element
173	87	Vinculos.index.action
174	87	Vinculos.listar.element
175	88	Vinculos.visualizar.action
176	88	Vinculos.visualizar.element
177	89	Dimensoes.adicionar.action
178	89	Dimensoes.adicionar.element
179	90	Dimensoes.excluir.action
180	90	Dimensoes.excluir.element
181	91	Dimensoes.editar.action
182	91	Dimensoes.editar.element
183	92	Dimensoes.index.action
184	92	Dimensoes.listar.element
185	93	Dimensoes.visualizar.action
186	93	Dimensoes.visualizar.element
187	94	Procedimentos.adicionar.action
188	94	Procedimentos.adicionar.element
189	95	Procedimentos.excluir.action
190	95	Procedimentos.excluir.element
191	96	Procedimentos.editar.action
192	96	Procedimentos.editar.element
193	97	Procedimentos.index.action
194	97	Procedimentos.listar.element
195	98	Procedimentos.visualizar.action
196	98	Procedimentos.visualizar.element
\.


                                                                                                                                                                      2399.dat                                                                                            0000600 0004000 0002000 00000000105 12651711120 014250  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	tuliocrr	202cb962ac59075b964b07152d234b70	1	1	\N	\N	1	1	\N	\N
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                           2404.dat                                                                                            0000600 0004000 0002000 00000000075 12651711120 014241  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        1	Teste111	0	\N	2016-01-14 21:13:12	2016-01-14 21:15:07
\.


                                                                                                                                                                                                                                                                                                                                                                                                                                                                   restore.sql                                                                                         0000600 0004000 0002000 00000063536 12651711120 015375  0                                                                                                    ustar 00postgres                        postgres                        0000000 0000000                                                                                                                                                                        --
-- NOTE:
--
-- File paths need to be edited. Search for $$PATH$$ and
-- replace it with the path to the directory containing
-- the extracted data files.
--
--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pessoa_id_fkey;
ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_perfil_id_fkey;
ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_departamento_id_fkey;
ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_permissao_id_fkey;
ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_perfil_id_fkey;
ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_faixa_id_fkey;
ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_conta_id_fkey;
ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_conta_id_fkey;
ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_conta_id_fkey;
ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_usuario_id_fkey;
ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_conta_id_fkey;
ALTER TABLE ONLY public.vinculos DROP CONSTRAINT vinculos_pkey;
ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_pkey;
ALTER TABLE ONLY public.procedimentos DROP CONSTRAINT procedimentos_pkey;
ALTER TABLE ONLY public.pessoas DROP CONSTRAINT pessoas_pkey;
ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_pkey;
ALTER TABLE ONLY public.perfis DROP CONSTRAINT perfis_pkey;
ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_pkey;
ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_pkey;
ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_pkey;
ALTER TABLE ONLY public.departamentos DROP CONSTRAINT departamentos_pkey;
ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_pkey;
ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
ALTER TABLE public.vinculos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.regras ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.procedimentos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.pessoas ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.permissoes ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.perfis ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.indicadores ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.faixas ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.dimensoes ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.departamentos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.contas ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.vinculos_id_seq;
DROP TABLE public.vinculos;
DROP SEQUENCE public.usuarios_id_seq;
DROP TABLE public.usuarios;
DROP SEQUENCE public.regras_id_seq;
DROP TABLE public.regras;
DROP SEQUENCE public.procedimentos_id_seq;
DROP TABLE public.procedimentos;
DROP SEQUENCE public.pessoas_id_seq;
DROP TABLE public.pessoas;
DROP SEQUENCE public.permissoes_id_seq;
DROP TABLE public.permissoes;
DROP SEQUENCE public.perfis_id_seq;
DROP TABLE public.perfis;
DROP SEQUENCE public.indicadores_id_seq;
DROP TABLE public.indicadores;
DROP SEQUENCE public.faixas_id_seq;
DROP TABLE public.faixas;
DROP SEQUENCE public.dimensoes_id_seq;
DROP TABLE public.dimensoes;
DROP SEQUENCE public.departamentos_id_seq;
DROP TABLE public.departamentos;
DROP SEQUENCE public.contas_id_seq;
DROP TABLE public.contas;
DROP SEQUENCE public.cargos_id_seq;
DROP TABLE public.cargos;
DROP FUNCTION public.sem_acento(character varying);
DROP EXTENSION plpgsql;
DROP SCHEMA public;
--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: sem_acento(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION sem_acento(character varying) RETURNS character varying
    LANGUAGE sql
    AS $_$
SELECT TRANSLATE($1, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$_$;


ALTER FUNCTION public.sem_acento(character varying) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cargos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cargos (
    id integer NOT NULL,
    titulo character varying(100),
    conta_id integer,
    descricao character varying(255),
    status integer DEFAULT 1
);


ALTER TABLE cargos OWNER TO postgres;

--
-- Name: cargos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cargos_id_seq OWNER TO postgres;

--
-- Name: cargos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cargos_id_seq OWNED BY cargos.id;


--
-- Name: contas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE contas (
    id integer NOT NULL,
    titulo character varying(255),
    usuario_id integer
);


ALTER TABLE contas OWNER TO postgres;

--
-- Name: contas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contas_id_seq OWNER TO postgres;

--
-- Name: contas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contas_id_seq OWNED BY contas.id;


--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamentos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE departamentos OWNER TO postgres;

--
-- Name: departamentos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE departamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE departamentos_id_seq OWNER TO postgres;

--
-- Name: departamentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE departamentos_id_seq OWNED BY departamentos.id;


--
-- Name: dimensoes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dimensoes (
    id integer NOT NULL,
    titulo character varying(200),
    ano character varying(4),
    conta_id integer,
    status integer DEFAULT 1
);


ALTER TABLE dimensoes OWNER TO postgres;

--
-- Name: dimensoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dimensoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE dimensoes_id_seq OWNER TO postgres;

--
-- Name: dimensoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE dimensoes_id_seq OWNED BY dimensoes.id;


--
-- Name: faixas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE faixas (
    id integer NOT NULL,
    titulo character varying(100),
    limite_vermelho numeric(10,2),
    limite_amarelo numeric(10,2),
    status integer,
    conta_id integer
);


ALTER TABLE faixas OWNER TO postgres;

--
-- Name: faixas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE faixas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE faixas_id_seq OWNER TO postgres;

--
-- Name: faixas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE faixas_id_seq OWNED BY faixas.id;


--
-- Name: indicadores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE indicadores (
    id integer NOT NULL,
    titulo character varying(255),
    conta_id integer,
    faixa_id integer
);


ALTER TABLE indicadores OWNER TO postgres;

--
-- Name: indicadores_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE indicadores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE indicadores_id_seq OWNER TO postgres;

--
-- Name: indicadores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE indicadores_id_seq OWNED BY indicadores.id;


--
-- Name: perfis; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE perfis (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    created timestamp without time zone,
    modified timestamp without time zone,
    conta_id integer
);


ALTER TABLE perfis OWNER TO postgres;

--
-- Name: perfis_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE perfis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE perfis_id_seq OWNER TO postgres;

--
-- Name: perfis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE perfis_id_seq OWNED BY perfis.id;


--
-- Name: permissoes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE permissoes (
    id integer NOT NULL,
    perfil_id integer,
    descricao character varying(255)
);


ALTER TABLE permissoes OWNER TO postgres;

--
-- Name: permissoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permissoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE permissoes_id_seq OWNER TO postgres;

--
-- Name: permissoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permissoes_id_seq OWNED BY permissoes.id;


--
-- Name: pessoas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pessoas (
    id integer NOT NULL,
    nome character varying(255),
    email character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1
);


ALTER TABLE pessoas OWNER TO postgres;

--
-- Name: pessoas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pessoas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pessoas_id_seq OWNER TO postgres;

--
-- Name: pessoas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pessoas_id_seq OWNED BY pessoas.id;


--
-- Name: procedimentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE procedimentos (
    id integer NOT NULL,
    titulo character varying(255),
    resultado_esperado text,
    passo text,
    requisito text,
    arquivo character varying(255),
    arquivo_dir character varying(255),
    usuario_id integer,
    certificado integer,
    conta_id integer,
    status integer DEFAULT 1
);


ALTER TABLE procedimentos OWNER TO postgres;

--
-- Name: procedimentos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE procedimentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE procedimentos_id_seq OWNER TO postgres;

--
-- Name: procedimentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE procedimentos_id_seq OWNED BY procedimentos.id;


--
-- Name: regras; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE regras (
    id integer NOT NULL,
    permissao_id integer,
    descricao character varying(255)
);


ALTER TABLE regras OWNER TO postgres;

--
-- Name: regras_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE regras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE regras_id_seq OWNER TO postgres;

--
-- Name: regras_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE regras_id_seq OWNED BY regras.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    login character varying(255),
    senha character varying(32),
    pessoa_id integer,
    perfil_id integer,
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1,
    departamento_id integer,
    conta_id integer,
    vinculo_id integer
);


ALTER TABLE usuarios OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- Name: vinculos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE vinculos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE vinculos OWNER TO postgres;

--
-- Name: vinculos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE vinculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vinculos_id_seq OWNER TO postgres;

--
-- Name: vinculos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE vinculos_id_seq OWNED BY vinculos.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos ALTER COLUMN id SET DEFAULT nextval('cargos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contas ALTER COLUMN id SET DEFAULT nextval('contas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos ALTER COLUMN id SET DEFAULT nextval('departamentos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dimensoes ALTER COLUMN id SET DEFAULT nextval('dimensoes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faixas ALTER COLUMN id SET DEFAULT nextval('faixas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indicadores ALTER COLUMN id SET DEFAULT nextval('indicadores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY perfis ALTER COLUMN id SET DEFAULT nextval('perfis_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permissoes ALTER COLUMN id SET DEFAULT nextval('permissoes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pessoas ALTER COLUMN id SET DEFAULT nextval('pessoas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY procedimentos ALTER COLUMN id SET DEFAULT nextval('procedimentos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY regras ALTER COLUMN id SET DEFAULT nextval('regras_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vinculos ALTER COLUMN id SET DEFAULT nextval('vinculos_id_seq'::regclass);


--
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cargos (id, titulo, conta_id, descricao, status) FROM stdin;
\.
COPY cargos (id, titulo, conta_id, descricao, status) FROM '$$PATH$$/2410.dat';

--
-- Name: cargos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cargos_id_seq', 1, false);


--
-- Data for Name: contas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY contas (id, titulo, usuario_id) FROM stdin;
\.
COPY contas (id, titulo, usuario_id) FROM '$$PATH$$/2402.dat';

--
-- Name: contas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('contas_id_seq', 1, false);


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY departamentos (id, titulo, status, conta_id, created, modified) FROM stdin;
\.
COPY departamentos (id, titulo, status, conta_id, created, modified) FROM '$$PATH$$/2389.dat';

--
-- Name: departamentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('departamentos_id_seq', 2, true);


--
-- Data for Name: dimensoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dimensoes (id, titulo, ano, conta_id, status) FROM stdin;
\.
COPY dimensoes (id, titulo, ano, conta_id, status) FROM '$$PATH$$/2412.dat';

--
-- Name: dimensoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('dimensoes_id_seq', 1, true);


--
-- Data for Name: faixas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY faixas (id, titulo, limite_vermelho, limite_amarelo, status, conta_id) FROM stdin;
\.
COPY faixas (id, titulo, limite_vermelho, limite_amarelo, status, conta_id) FROM '$$PATH$$/2406.dat';

--
-- Name: faixas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faixas_id_seq', 1, true);


--
-- Data for Name: indicadores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY indicadores (id, titulo, conta_id, faixa_id) FROM stdin;
\.
COPY indicadores (id, titulo, conta_id, faixa_id) FROM '$$PATH$$/2408.dat';

--
-- Name: indicadores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('indicadores_id_seq', 1, false);


--
-- Data for Name: perfis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY perfis (id, titulo, status, created, modified, conta_id) FROM stdin;
\.
COPY perfis (id, titulo, status, created, modified, conta_id) FROM '$$PATH$$/2391.dat';

--
-- Name: perfis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('perfis_id_seq', 12, true);


--
-- Data for Name: permissoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY permissoes (id, perfil_id, descricao) FROM stdin;
\.
COPY permissoes (id, perfil_id, descricao) FROM '$$PATH$$/2393.dat';

--
-- Name: permissoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permissoes_id_seq', 98, true);


--
-- Data for Name: pessoas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pessoas (id, nome, email, created, modified, status) FROM stdin;
\.
COPY pessoas (id, nome, email, created, modified, status) FROM '$$PATH$$/2395.dat';

--
-- Name: pessoas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pessoas_id_seq', 1, true);


--
-- Data for Name: procedimentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY procedimentos (id, titulo, resultado_esperado, passo, requisito, arquivo, arquivo_dir, usuario_id, certificado, conta_id, status) FROM stdin;
\.
COPY procedimentos (id, titulo, resultado_esperado, passo, requisito, arquivo, arquivo_dir, usuario_id, certificado, conta_id, status) FROM '$$PATH$$/2414.dat';

--
-- Name: procedimentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('procedimentos_id_seq', 1, false);


--
-- Data for Name: regras; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY regras (id, permissao_id, descricao) FROM stdin;
\.
COPY regras (id, permissao_id, descricao) FROM '$$PATH$$/2397.dat';

--
-- Name: regras_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('regras_id_seq', 196, true);


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuarios (id, login, senha, pessoa_id, perfil_id, created, modified, status, departamento_id, conta_id, vinculo_id) FROM stdin;
\.
COPY usuarios (id, login, senha, pessoa_id, perfil_id, created, modified, status, departamento_id, conta_id, vinculo_id) FROM '$$PATH$$/2399.dat';

--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 1, true);


--
-- Data for Name: vinculos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY vinculos (id, titulo, status, conta_id, created, modified) FROM stdin;
\.
COPY vinculos (id, titulo, status, conta_id, created, modified) FROM '$$PATH$$/2404.dat';

--
-- Name: vinculos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('vinculos_id_seq', 1, true);


--
-- Name: cargos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);


--
-- Name: contas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_pkey PRIMARY KEY (id);


--
-- Name: departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id);


--
-- Name: dimensoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_pkey PRIMARY KEY (id);


--
-- Name: faixas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_pkey PRIMARY KEY (id);


--
-- Name: indicadores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_pkey PRIMARY KEY (id);


--
-- Name: perfis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY perfis
    ADD CONSTRAINT perfis_pkey PRIMARY KEY (id);


--
-- Name: permissoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_pkey PRIMARY KEY (id);


--
-- Name: pessoas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pessoas
    ADD CONSTRAINT pessoas_pkey PRIMARY KEY (id);


--
-- Name: procedimentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY procedimentos
    ADD CONSTRAINT procedimentos_pkey PRIMARY KEY (id);


--
-- Name: regras_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_pkey PRIMARY KEY (id);


--
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: vinculos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vinculos
    ADD CONSTRAINT vinculos_pkey PRIMARY KEY (id);


--
-- Name: cargos_conta_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);


--
-- Name: contas_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES usuarios(id);


--
-- Name: dimensoes_conta_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);


--
-- Name: faixas_conta_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);


--
-- Name: indicadores_conta_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);


--
-- Name: indicadores_faixa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_faixa_id_fkey FOREIGN KEY (faixa_id) REFERENCES faixas(id);


--
-- Name: permissoes_perfil_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);


--
-- Name: regras_permissao_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_permissao_id_fkey FOREIGN KEY (permissao_id) REFERENCES permissoes(id);


--
-- Name: usuarios_departamento_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamentos(id);


--
-- Name: usuarios_perfil_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);


--
-- Name: usuarios_pessoa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pessoa_id_fkey FOREIGN KEY (pessoa_id) REFERENCES pessoas(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  