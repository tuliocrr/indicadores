PGDMP                          t            civisindicadores    9.2.4    9.2.4     B	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            C	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            D	           1262    200585    civisindicadores    DATABASE     n   CREATE DATABASE civisindicadores WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';
     DROP DATABASE civisindicadores;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            E	           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    6            F	           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    6            �            3079    11995    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            G	           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    198            �            1255    200586    sem_acento(character varying)    FUNCTION       CREATE FUNCTION sem_acento(character varying) RETURNS character varying
    LANGUAGE sql
    AS $_$
SELECT TRANSLATE($1, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$_$;
 4   DROP FUNCTION public.sem_acento(character varying);
       public       postgres    false    6            �            1259    200587    cargos    TABLE     �   CREATE TABLE cargos (
    id integer NOT NULL,
    titulo character varying(100),
    conta_id integer,
    descricao character varying(255),
    status integer DEFAULT 1
);
    DROP TABLE public.cargos;
       public         postgres    false    6            �            1259    200591    cargos_id_seq    SEQUENCE     o   CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cargos_id_seq;
       public       postgres    false    6    168            H	           0    0    cargos_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE cargos_id_seq OWNED BY cargos.id;
            public       postgres    false    169            �            1259    200593    contas    TABLE     l   CREATE TABLE contas (
    id integer NOT NULL,
    titulo character varying(255),
    usuario_id integer
);
    DROP TABLE public.contas;
       public         postgres    false    6            �            1259    200596    contas_id_seq    SEQUENCE     o   CREATE SEQUENCE contas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.contas_id_seq;
       public       postgres    false    170    6            I	           0    0    contas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE contas_id_seq OWNED BY contas.id;
            public       postgres    false    171            �            1259    200598    departamentos    TABLE     �   CREATE TABLE departamentos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
 !   DROP TABLE public.departamentos;
       public         postgres    false    6            �            1259    200602    departamentos_id_seq    SEQUENCE     v   CREATE SEQUENCE departamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.departamentos_id_seq;
       public       postgres    false    6    172            J	           0    0    departamentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE departamentos_id_seq OWNED BY departamentos.id;
            public       postgres    false    173            �            1259    200604 	   dimensoes    TABLE     �   CREATE TABLE dimensoes (
    id integer NOT NULL,
    titulo character varying(200),
    ano character varying(4),
    conta_id integer,
    status integer DEFAULT 1
);
    DROP TABLE public.dimensoes;
       public         postgres    false    6            �            1259    200608    dimensoes_id_seq    SEQUENCE     r   CREATE SEQUENCE dimensoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.dimensoes_id_seq;
       public       postgres    false    174    6            K	           0    0    dimensoes_id_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE dimensoes_id_seq OWNED BY dimensoes.id;
            public       postgres    false    175            �            1259    200610    faixas    TABLE     �   CREATE TABLE faixas (
    id integer NOT NULL,
    titulo character varying(100),
    limite_vermelho numeric(10,2),
    limite_amarelo numeric(10,2),
    status integer,
    conta_id integer
);
    DROP TABLE public.faixas;
       public         postgres    false    6            �            1259    200613    faixas_id_seq    SEQUENCE     o   CREATE SEQUENCE faixas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.faixas_id_seq;
       public       postgres    false    6    176            L	           0    0    faixas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE faixas_id_seq OWNED BY faixas.id;
            public       postgres    false    177            �            1259    200615    indicadores    TABLE     �   CREATE TABLE indicadores (
    id integer NOT NULL,
    titulo character varying(255),
    conta_id integer,
    faixa_id integer
);
    DROP TABLE public.indicadores;
       public         postgres    false    6            �            1259    200618    indicadores_id_seq    SEQUENCE     t   CREATE SEQUENCE indicadores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.indicadores_id_seq;
       public       postgres    false    178    6            M	           0    0    indicadores_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE indicadores_id_seq OWNED BY indicadores.id;
            public       postgres    false    179            �            1259    200620    perfis    TABLE     �   CREATE TABLE perfis (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    created timestamp without time zone,
    modified timestamp without time zone,
    conta_id integer
);
    DROP TABLE public.perfis;
       public         postgres    false    6            �            1259    200624    perfis_id_seq    SEQUENCE     o   CREATE SEQUENCE perfis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.perfis_id_seq;
       public       postgres    false    180    6            N	           0    0    perfis_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE perfis_id_seq OWNED BY perfis.id;
            public       postgres    false    181            �            1259    200626 
   permissoes    TABLE     r   CREATE TABLE permissoes (
    id integer NOT NULL,
    perfil_id integer,
    descricao character varying(255)
);
    DROP TABLE public.permissoes;
       public         postgres    false    6            �            1259    200629    permissoes_id_seq    SEQUENCE     s   CREATE SEQUENCE permissoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.permissoes_id_seq;
       public       postgres    false    182    6            O	           0    0    permissoes_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE permissoes_id_seq OWNED BY permissoes.id;
            public       postgres    false    183            �            1259    200631    pessoas    TABLE     �  CREATE TABLE pessoas (
    id integer NOT NULL,
    nome character varying(255),
    email character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1,
    logradouro character varying(255),
    numero integer,
    cep character varying(255),
    bairro character varying(255),
    cidade character varying(255),
    uf character(2),
    cpf character varying(255),
    rg character varying(255)
);
    DROP TABLE public.pessoas;
       public         postgres    false    6            �            1259    200638    pessoas_id_seq    SEQUENCE     p   CREATE SEQUENCE pessoas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.pessoas_id_seq;
       public       postgres    false    184    6            P	           0    0    pessoas_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE pessoas_id_seq OWNED BY pessoas.id;
            public       postgres    false    185            �            1259    200640    procedimentos    TABLE     M  CREATE TABLE procedimentos (
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
       public         postgres    false    6            �            1259    200647    procedimentos_id_seq    SEQUENCE     v   CREATE SEQUENCE procedimentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.procedimentos_id_seq;
       public       postgres    false    186    6            Q	           0    0    procedimentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE procedimentos_id_seq OWNED BY procedimentos.id;
            public       postgres    false    187            �            1259    200649    regras    TABLE     q   CREATE TABLE regras (
    id integer NOT NULL,
    permissao_id integer,
    descricao character varying(255)
);
    DROP TABLE public.regras;
       public         postgres    false    6            �            1259    200652    regras_id_seq    SEQUENCE     o   CREATE SEQUENCE regras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.regras_id_seq;
       public       postgres    false    6    188            R	           0    0    regras_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE regras_id_seq OWNED BY regras.id;
            public       postgres    false    189            �            1259    200763    setores    TABLE     �   CREATE TABLE setores (
    id integer NOT NULL,
    titulo character varying(255),
    tipo_setor_id integer,
    conta_id integer,
    status integer DEFAULT 1,
    created timestamp without time zone,
    modified timestamp without time zone
);
    DROP TABLE public.setores;
       public         postgres    false    6            �            1259    200761    setores_id_seq    SEQUENCE     p   CREATE SEQUENCE setores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.setores_id_seq;
       public       postgres    false    195    6            S	           0    0    setores_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE setores_id_seq OWNED BY setores.id;
            public       postgres    false    194            �            1259    200772 
   tipo_setor    TABLE     v   CREATE TABLE tipo_setor (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1
);
    DROP TABLE public.tipo_setor;
       public         postgres    false    6            �            1259    200770    tipo_setor_id_seq    SEQUENCE     s   CREATE SEQUENCE tipo_setor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.tipo_setor_id_seq;
       public       postgres    false    197    6            T	           0    0    tipo_setor_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE tipo_setor_id_seq OWNED BY tipo_setor.id;
            public       postgres    false    196            �            1259    200654    usuarios    TABLE     �  CREATE TABLE usuarios (
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
    vinculo_id integer,
    observacao text,
    cargo_id integer,
    setor_id integer,
    chefe integer,
    imagem_perfil character varying(255)
);
    DROP TABLE public.usuarios;
       public         postgres    false    6            �            1259    200658    usuarios_id_seq    SEQUENCE     q   CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public       postgres    false    190    6            U	           0    0    usuarios_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;
            public       postgres    false    191            �            1259    200660    vinculos    TABLE     �   CREATE TABLE vinculos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
    DROP TABLE public.vinculos;
       public         postgres    false    6            �            1259    200664    vinculos_id_seq    SEQUENCE     q   CREATE SEQUENCE vinculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.vinculos_id_seq;
       public       postgres    false    192    6            V	           0    0    vinculos_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE vinculos_id_seq OWNED BY vinculos.id;
            public       postgres    false    193            �           2604    200666    id    DEFAULT     X   ALTER TABLE ONLY cargos ALTER COLUMN id SET DEFAULT nextval('cargos_id_seq'::regclass);
 8   ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    169    168            �           2604    200667    id    DEFAULT     X   ALTER TABLE ONLY contas ALTER COLUMN id SET DEFAULT nextval('contas_id_seq'::regclass);
 8   ALTER TABLE public.contas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    171    170            �           2604    200668    id    DEFAULT     f   ALTER TABLE ONLY departamentos ALTER COLUMN id SET DEFAULT nextval('departamentos_id_seq'::regclass);
 ?   ALTER TABLE public.departamentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    173    172            �           2604    200669    id    DEFAULT     ^   ALTER TABLE ONLY dimensoes ALTER COLUMN id SET DEFAULT nextval('dimensoes_id_seq'::regclass);
 ;   ALTER TABLE public.dimensoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    175    174            �           2604    200670    id    DEFAULT     X   ALTER TABLE ONLY faixas ALTER COLUMN id SET DEFAULT nextval('faixas_id_seq'::regclass);
 8   ALTER TABLE public.faixas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    177    176            �           2604    200671    id    DEFAULT     b   ALTER TABLE ONLY indicadores ALTER COLUMN id SET DEFAULT nextval('indicadores_id_seq'::regclass);
 =   ALTER TABLE public.indicadores ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    179    178            �           2604    200672    id    DEFAULT     X   ALTER TABLE ONLY perfis ALTER COLUMN id SET DEFAULT nextval('perfis_id_seq'::regclass);
 8   ALTER TABLE public.perfis ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    181    180            �           2604    200673    id    DEFAULT     `   ALTER TABLE ONLY permissoes ALTER COLUMN id SET DEFAULT nextval('permissoes_id_seq'::regclass);
 <   ALTER TABLE public.permissoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    183    182            �           2604    200674    id    DEFAULT     Z   ALTER TABLE ONLY pessoas ALTER COLUMN id SET DEFAULT nextval('pessoas_id_seq'::regclass);
 9   ALTER TABLE public.pessoas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    185    184            �           2604    200675    id    DEFAULT     f   ALTER TABLE ONLY procedimentos ALTER COLUMN id SET DEFAULT nextval('procedimentos_id_seq'::regclass);
 ?   ALTER TABLE public.procedimentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    187    186            �           2604    200676    id    DEFAULT     X   ALTER TABLE ONLY regras ALTER COLUMN id SET DEFAULT nextval('regras_id_seq'::regclass);
 8   ALTER TABLE public.regras ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    189    188            �           2604    200766    id    DEFAULT     Z   ALTER TABLE ONLY setores ALTER COLUMN id SET DEFAULT nextval('setores_id_seq'::regclass);
 9   ALTER TABLE public.setores ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    194    195    195            �           2604    200775    id    DEFAULT     `   ALTER TABLE ONLY tipo_setor ALTER COLUMN id SET DEFAULT nextval('tipo_setor_id_seq'::regclass);
 <   ALTER TABLE public.tipo_setor ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            �           2604    200677    id    DEFAULT     \   ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    191    190            �           2604    200678    id    DEFAULT     \   ALTER TABLE ONLY vinculos ALTER COLUMN id SET DEFAULT nextval('vinculos_id_seq'::regclass);
 :   ALTER TABLE public.vinculos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    193    192            "	          0    200587    cargos 
   TABLE DATA               B   COPY cargos (id, titulo, conta_id, descricao, status) FROM stdin;
    public       postgres    false    168   w�       W	           0    0    cargos_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('cargos_id_seq', 2, true);
            public       postgres    false    169            $	          0    200593    contas 
   TABLE DATA               1   COPY contas (id, titulo, usuario_id) FROM stdin;
    public       postgres    false    170          X	           0    0    contas_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('contas_id_seq', 1, true);
            public       postgres    false    171            &	          0    200598    departamentos 
   TABLE DATA               Q   COPY departamentos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    172   �       Y	           0    0    departamentos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('departamentos_id_seq', 2, true);
            public       postgres    false    173            (	          0    200604 	   dimensoes 
   TABLE DATA               ?   COPY dimensoes (id, titulo, ano, conta_id, status) FROM stdin;
    public       postgres    false    174   )�       Z	           0    0    dimensoes_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('dimensoes_id_seq', 1, true);
            public       postgres    false    175            *	          0    200610    faixas 
   TABLE DATA               X   COPY faixas (id, titulo, limite_vermelho, limite_amarelo, status, conta_id) FROM stdin;
    public       postgres    false    176   V�       [	           0    0    faixas_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('faixas_id_seq', 1, true);
            public       postgres    false    177            ,	          0    200615    indicadores 
   TABLE DATA               >   COPY indicadores (id, titulo, conta_id, faixa_id) FROM stdin;
    public       postgres    false    178   ��       \	           0    0    indicadores_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('indicadores_id_seq', 1, false);
            public       postgres    false    179            .	          0    200620    perfis 
   TABLE DATA               J   COPY perfis (id, titulo, status, created, modified, conta_id) FROM stdin;
    public       postgres    false    180   ��       ]	           0    0    perfis_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('perfis_id_seq', 12, true);
            public       postgres    false    181            0	          0    200626 
   permissoes 
   TABLE DATA               7   COPY permissoes (id, perfil_id, descricao) FROM stdin;
    public       postgres    false    182   �       ^	           0    0    permissoes_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('permissoes_id_seq', 98, true);
            public       postgres    false    183            2	          0    200631    pessoas 
   TABLE DATA               |   COPY pessoas (id, nome, email, created, modified, status, logradouro, numero, cep, bairro, cidade, uf, cpf, rg) FROM stdin;
    public       postgres    false    184   Z�       _	           0    0    pessoas_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('pessoas_id_seq', 3, true);
            public       postgres    false    185            4	          0    200640    procedimentos 
   TABLE DATA               �   COPY procedimentos (id, titulo, resultado_esperado, passo, requisito, arquivo, arquivo_dir, usuario_id, certificado, conta_id, status) FROM stdin;
    public       postgres    false    186   J�       `	           0    0    procedimentos_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('procedimentos_id_seq', 1, false);
            public       postgres    false    187            6	          0    200649    regras 
   TABLE DATA               6   COPY regras (id, permissao_id, descricao) FROM stdin;
    public       postgres    false    188   g�       a	           0    0    regras_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('regras_id_seq', 196, true);
            public       postgres    false    189            =	          0    200763    setores 
   TABLE DATA               Z   COPY setores (id, titulo, tipo_setor_id, conta_id, status, created, modified) FROM stdin;
    public       postgres    false    195   ֏       b	           0    0    setores_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('setores_id_seq', 3, true);
            public       postgres    false    194            ?	          0    200772 
   tipo_setor 
   TABLE DATA               1   COPY tipo_setor (id, titulo, status) FROM stdin;
    public       postgres    false    197   E�       c	           0    0    tipo_setor_id_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('tipo_setor_id_seq', 2, true);
            public       postgres    false    196            8	          0    200654    usuarios 
   TABLE DATA               �   COPY usuarios (id, login, senha, pessoa_id, perfil_id, created, modified, status, departamento_id, conta_id, vinculo_id, observacao, cargo_id, setor_id, chefe, imagem_perfil) FROM stdin;
    public       postgres    false    190   u�       d	           0    0    usuarios_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('usuarios_id_seq', 3, true);
            public       postgres    false    191            :	          0    200660    vinculos 
   TABLE DATA               L   COPY vinculos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    192   ?�       e	           0    0    vinculos_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('vinculos_id_seq', 2, true);
            public       postgres    false    193            �           2606    200680    cargos_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
       public         postgres    false    168    168            �           2606    200682    contas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_pkey;
       public         postgres    false    170    170            �           2606    200684    departamentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.departamentos DROP CONSTRAINT departamentos_pkey;
       public         postgres    false    172    172            �           2606    200686    dimensoes_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_pkey;
       public         postgres    false    174    174             	           2606    200688    faixas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_pkey;
       public         postgres    false    176    176            	           2606    200690    indicadores_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_pkey;
       public         postgres    false    178    178            	           2606    200692    perfis_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY perfis
    ADD CONSTRAINT perfis_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.perfis DROP CONSTRAINT perfis_pkey;
       public         postgres    false    180    180            	           2606    200694    permissoes_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_pkey;
       public         postgres    false    182    182            	           2606    200696    pessoas_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY pessoas
    ADD CONSTRAINT pessoas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.pessoas DROP CONSTRAINT pessoas_pkey;
       public         postgres    false    184    184            
	           2606    200698    procedimentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY procedimentos
    ADD CONSTRAINT procedimentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.procedimentos DROP CONSTRAINT procedimentos_pkey;
       public         postgres    false    186    186            	           2606    200700    regras_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_pkey;
       public         postgres    false    188    188            	           2606    200769    setores_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY setores
    ADD CONSTRAINT setores_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.setores DROP CONSTRAINT setores_pkey;
       public         postgres    false    195    195            	           2606    200778    tipo_setor_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY tipo_setor
    ADD CONSTRAINT tipo_setor_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.tipo_setor DROP CONSTRAINT tipo_setor_pkey;
       public         postgres    false    197    197            	           2606    200702    usuarios_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    190    190            	           2606    200704    vinculos_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY vinculos
    ADD CONSTRAINT vinculos_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.vinculos DROP CONSTRAINT vinculos_pkey;
       public         postgres    false    192    192            	           2606    200705    cargos_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_conta_id_fkey;
       public       postgres    false    2298    170    168            	           2606    200710    contas_usuario_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
 G   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_usuario_id_fkey;
       public       postgres    false    2318    170    190            	           2606    200715    dimensoes_conta_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 K   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_conta_id_fkey;
       public       postgres    false    2298    174    170            	           2606    200720    faixas_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_conta_id_fkey;
       public       postgres    false    176    170    2298            	           2606    200725    indicadores_conta_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_conta_id_fkey;
       public       postgres    false    170    178    2298            	           2606    200730    indicadores_faixa_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_faixa_id_fkey FOREIGN KEY (faixa_id) REFERENCES faixas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_faixa_id_fkey;
       public       postgres    false    176    2304    178            	           2606    200735    permissoes_perfil_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 N   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_perfil_id_fkey;
       public       postgres    false    2308    182    180            	           2606    200740    regras_permissao_id_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_permissao_id_fkey FOREIGN KEY (permissao_id) REFERENCES permissoes(id);
 I   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_permissao_id_fkey;
       public       postgres    false    182    2310    188            !	           2606    200784    setores_conta_id_fkey    FK CONSTRAINT     p   ALTER TABLE ONLY setores
    ADD CONSTRAINT setores_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 G   ALTER TABLE ONLY public.setores DROP CONSTRAINT setores_conta_id_fkey;
       public       postgres    false    195    170    2298             	           2606    200779    setores_tipo_setor_id_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY setores
    ADD CONSTRAINT setores_tipo_setor_id_fkey FOREIGN KEY (tipo_setor_id) REFERENCES tipo_setor(id);
 L   ALTER TABLE ONLY public.setores DROP CONSTRAINT setores_tipo_setor_id_fkey;
       public       postgres    false    195    197    2324            	           2606    200792    usuarios_departamento_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamentos(id);
 P   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_departamento_id_fkey;
       public       postgres    false    190    172    2300            	           2606    200797    usuarios_perfil_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_perfil_id_fkey;
       public       postgres    false    180    190    2308            	           2606    200802    usuarios_pessoa_id_fkey    FK CONSTRAINT     u   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pessoa_id_fkey FOREIGN KEY (pessoa_id) REFERENCES pessoas(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pessoa_id_fkey;
       public       postgres    false    184    190    2312            "	   ;   x�3�J-(J-N�+I�+IUH��M-J�L��4��4�2�(�O/J�ML�/���qqq ���      $	      x�3�t�,�,�4����� �%      &	   0   x�3�t��K�KN�,��4�? �2�I-.I-644�4����qqq S@�      (	      x�3�,I-"NC#cNCNC�=... FO�      *	   !   x�3�,I-.I�4�30���1~��\1z\\\ d��      ,	      x������ � �      .	   d   x�3�tL����,.)JL�/�4���4204�50�52Q04�25�22�4�2�tO-.��"C.C#N�Ҽ����Ģ�|�L�����������V1C�=... ��      0	   2  x�m�Mn�0��5&�P�-����ȦYuc��D 2 E�Mգ�b��c����,ay�ޏ�o�Ṇ
�ָ4�zi;L�������`.���(��M_��\',9Y�	E��^5#L��6c"	)Q�H 1����1Յ�4P�LIۋq���I�,�2��F��*�͸�\m;D�n(�ݲ�r;_m'�꫁�!��0��b!͢ʱ �
l�P��3����+'A�"I҂�H���������C=�E�*j���yTQ�Eԉ���'�U�����S��F��~Z� wKx��m�-�4M�W      2	   �   x�u�AN�0E��S�1��qm�JK+�Z�U7&��R�N����	�H���H����܇H�.]]�a��e��u��^�F�*�+���Ņ8l��~H�=�B��iy���^R�a�w�g��.=�@�L7�#+�A�R(�����ݐZ��H�}���2��~�8��
a��{j��xN�ܮ���1�UN_��!��QƢ���1�̨F�ueTh      4	      x������ � �      6	   _  x�}����0E���,�7Yg�z��J#�J@������Ԑ�Н��ޱ�pDE���󚯷�����z�׷�xǇ���r^~/����f|·w�Z���#�p9��Tj�,�|9-�Ҋ59�[�J����t���4९T ��cYf��RQ�\O�����\֓ ��V��FOJ�=�!�lL)m+ԩRڑ7
���9�틍R:<��鍙I�[���m�2Z�\��0�1el{w���M3~��!��˼��(b�'
S�9;	p�ZEAm��f��q�P��Ƭ�P��:
�@���2������s^����De6�J�0�s]��qf�����V�������eZ����cǱ����q0��뜟���Es=Q�
����í��.���:q��E]`+����h
��9-}ϗ��,.&�9�#��q�7��Y�[�l�o���(��-0n�ᅪa�/I��{X�A���_����n�E��$xH�4U�^!6N�� ,VRu�����0�%]�V#����G�n2D�G(Y�X�G<���y�H�0u]��
���6ޒ�C�]�Ex�.�Z��K���)v�6��U����v8�{z��      =	   _   x�3�t��K�KN�,��4C#C3]#]C+S+cslb\F��)��y��%E�%�e8��Xb�2��/H-JL���K��4®���W� p=(N      ?	       x�3�.-H-��/�4�2���K�qb���� �=      8	   �   x�]�M
1���)����餇�n�N+�028���B�d���=��~��uۀ�k�s5�hcԂ��-�F]�CG���z L����h�����}����ǮZH܌�X��z�%f��B_W:�&���O��/�'�e����B#�KW/�<��ljh�3�y��K��z��o7�}I�f��BxG�?�      :	   Q   x�3�I-.I544�4�4�4204�50�54Q02�24�24B3�20�2�tMK-�,���2*R0�J[`����� 3�U     