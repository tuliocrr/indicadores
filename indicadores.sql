PGDMP         #                 t           indicadores    9.4.4    9.4.4 o    q	           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            r	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            s	           1262    22883    indicadores    DATABASE     i   CREATE DATABASE indicadores WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';
    DROP DATABASE indicadores;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false            t	           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    6            u	           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  postgres    false    6            �            3079    12123    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false            v	           0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    198            �            1255    22884    sem_acento(character varying)    FUNCTION       CREATE FUNCTION sem_acento(character varying) RETURNS character varying
    LANGUAGE sql
    AS $_$
SELECT TRANSLATE($1, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$_$;
 4   DROP FUNCTION public.sem_acento(character varying);
       public       postgres    false    6            �            1259    23037    cargos    TABLE     �   CREATE TABLE cargos (
    id integer NOT NULL,
    titulo character varying(100),
    conta_id integer,
    descricao character varying(255),
    status integer DEFAULT 1
);
    DROP TABLE public.cargos;
       public         postgres    false    6            �            1259    23035    cargos_id_seq    SEQUENCE     o   CREATE SEQUENCE cargos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cargos_id_seq;
       public       postgres    false    6    193            w	           0    0    cargos_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE cargos_id_seq OWNED BY cargos.id;
            public       postgres    false    192            �            1259    22967    contas    TABLE     l   CREATE TABLE contas (
    id integer NOT NULL,
    titulo character varying(255),
    usuario_id integer
);
    DROP TABLE public.contas;
       public         postgres    false    6            �            1259    22965    contas_id_seq    SEQUENCE     o   CREATE SEQUENCE contas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.contas_id_seq;
       public       postgres    false    185    6            x	           0    0    contas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE contas_id_seq OWNED BY contas.id;
            public       postgres    false    184            �            1259    22885    departamentos    TABLE     �   CREATE TABLE departamentos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
 !   DROP TABLE public.departamentos;
       public         postgres    false    6            �            1259    22889    departamentos_id_seq    SEQUENCE     v   CREATE SEQUENCE departamentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.departamentos_id_seq;
       public       postgres    false    6    172            y	           0    0    departamentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE departamentos_id_seq OWNED BY departamentos.id;
            public       postgres    false    173            �            1259    23051 	   dimensoes    TABLE     �   CREATE TABLE dimensoes (
    id integer NOT NULL,
    titulo character varying(200),
    ano character varying(4),
    conta_id integer,
    status integer DEFAULT 1
);
    DROP TABLE public.dimensoes;
       public         postgres    false    6            �            1259    23049    dimensoes_id_seq    SEQUENCE     r   CREATE SEQUENCE dimensoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.dimensoes_id_seq;
       public       postgres    false    195    6            z	           0    0    dimensoes_id_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE dimensoes_id_seq OWNED BY dimensoes.id;
            public       postgres    false    194            �            1259    22999    faixas    TABLE     �   CREATE TABLE faixas (
    id integer NOT NULL,
    titulo character varying(100),
    limite_vermelho numeric(10,2),
    limite_amarelo numeric(10,2),
    status integer,
    conta_id integer
);
    DROP TABLE public.faixas;
       public         postgres    false    6            �            1259    22997    faixas_id_seq    SEQUENCE     o   CREATE SEQUENCE faixas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.faixas_id_seq;
       public       postgres    false    189    6            {	           0    0    faixas_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE faixas_id_seq OWNED BY faixas.id;
            public       postgres    false    188            �            1259    23012    indicadores    TABLE     �   CREATE TABLE indicadores (
    id integer NOT NULL,
    titulo character varying(255),
    conta_id integer,
    faixa_id integer
);
    DROP TABLE public.indicadores;
       public         postgres    false    6            �            1259    23010    indicadores_id_seq    SEQUENCE     t   CREATE SEQUENCE indicadores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.indicadores_id_seq;
       public       postgres    false    191    6            |	           0    0    indicadores_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE indicadores_id_seq OWNED BY indicadores.id;
            public       postgres    false    190            �            1259    22891    perfis    TABLE     �   CREATE TABLE perfis (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    created timestamp without time zone,
    modified timestamp without time zone,
    conta_id integer
);
    DROP TABLE public.perfis;
       public         postgres    false    6            �            1259    22895    perfis_id_seq    SEQUENCE     o   CREATE SEQUENCE perfis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.perfis_id_seq;
       public       postgres    false    174    6            }	           0    0    perfis_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE perfis_id_seq OWNED BY perfis.id;
            public       postgres    false    175            �            1259    22897 
   permissoes    TABLE     r   CREATE TABLE permissoes (
    id integer NOT NULL,
    perfil_id integer,
    descricao character varying(255)
);
    DROP TABLE public.permissoes;
       public         postgres    false    6            �            1259    22900    permissoes_id_seq    SEQUENCE     s   CREATE SEQUENCE permissoes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.permissoes_id_seq;
       public       postgres    false    6    176            ~	           0    0    permissoes_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE permissoes_id_seq OWNED BY permissoes.id;
            public       postgres    false    177            �            1259    22902    pessoas    TABLE     �   CREATE TABLE pessoas (
    id integer NOT NULL,
    nome character varying(255),
    email character varying(255),
    created timestamp without time zone,
    modified timestamp without time zone,
    status integer DEFAULT 1
);
    DROP TABLE public.pessoas;
       public         postgres    false    6            �            1259    22909    pessoas_id_seq    SEQUENCE     p   CREATE SEQUENCE pessoas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.pessoas_id_seq;
       public       postgres    false    178    6            	           0    0    pessoas_id_seq    SEQUENCE OWNED BY     3   ALTER SEQUENCE pessoas_id_seq OWNED BY pessoas.id;
            public       postgres    false    179            �            1259    23077    procedimentos    TABLE     M  CREATE TABLE procedimentos (
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
       public         postgres    false    6            �            1259    23075    procedimentos_id_seq    SEQUENCE     v   CREATE SEQUENCE procedimentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.procedimentos_id_seq;
       public       postgres    false    197    6            �	           0    0    procedimentos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE procedimentos_id_seq OWNED BY procedimentos.id;
            public       postgres    false    196            �            1259    22911    regras    TABLE     q   CREATE TABLE regras (
    id integer NOT NULL,
    permissao_id integer,
    descricao character varying(255)
);
    DROP TABLE public.regras;
       public         postgres    false    6            �            1259    22914    regras_id_seq    SEQUENCE     o   CREATE SEQUENCE regras_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.regras_id_seq;
       public       postgres    false    180    6            �	           0    0    regras_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE regras_id_seq OWNED BY regras.id;
            public       postgres    false    181            �            1259    22916    usuarios    TABLE     `  CREATE TABLE usuarios (
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
       public         postgres    false    6            �            1259    22920    usuarios_id_seq    SEQUENCE     q   CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public       postgres    false    6    182            �	           0    0    usuarios_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;
            public       postgres    false    183            �            1259    22980    vinculos    TABLE     �   CREATE TABLE vinculos (
    id integer NOT NULL,
    titulo character varying(255),
    status integer DEFAULT 1,
    conta_id integer,
    created timestamp without time zone,
    modified timestamp without time zone
);
    DROP TABLE public.vinculos;
       public         postgres    false    6            �            1259    22978    vinculos_id_seq    SEQUENCE     q   CREATE SEQUENCE vinculos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.vinculos_id_seq;
       public       postgres    false    6    187            �	           0    0    vinculos_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE vinculos_id_seq OWNED BY vinculos.id;
            public       postgres    false    186            �           2604    23040    id    DEFAULT     X   ALTER TABLE ONLY cargos ALTER COLUMN id SET DEFAULT nextval('cargos_id_seq'::regclass);
 8   ALTER TABLE public.cargos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    193    192    193            �           2604    22970    id    DEFAULT     X   ALTER TABLE ONLY contas ALTER COLUMN id SET DEFAULT nextval('contas_id_seq'::regclass);
 8   ALTER TABLE public.contas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    185    184    185            �           2604    22922    id    DEFAULT     f   ALTER TABLE ONLY departamentos ALTER COLUMN id SET DEFAULT nextval('departamentos_id_seq'::regclass);
 ?   ALTER TABLE public.departamentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    173    172            �           2604    23054    id    DEFAULT     ^   ALTER TABLE ONLY dimensoes ALTER COLUMN id SET DEFAULT nextval('dimensoes_id_seq'::regclass);
 ;   ALTER TABLE public.dimensoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    195    194    195            �           2604    23002    id    DEFAULT     X   ALTER TABLE ONLY faixas ALTER COLUMN id SET DEFAULT nextval('faixas_id_seq'::regclass);
 8   ALTER TABLE public.faixas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    188    189    189            �           2604    23015    id    DEFAULT     b   ALTER TABLE ONLY indicadores ALTER COLUMN id SET DEFAULT nextval('indicadores_id_seq'::regclass);
 =   ALTER TABLE public.indicadores ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    190    191    191            �           2604    22923    id    DEFAULT     X   ALTER TABLE ONLY perfis ALTER COLUMN id SET DEFAULT nextval('perfis_id_seq'::regclass);
 8   ALTER TABLE public.perfis ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    175    174            �           2604    22924    id    DEFAULT     `   ALTER TABLE ONLY permissoes ALTER COLUMN id SET DEFAULT nextval('permissoes_id_seq'::regclass);
 <   ALTER TABLE public.permissoes ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    177    176            �           2604    22925    id    DEFAULT     Z   ALTER TABLE ONLY pessoas ALTER COLUMN id SET DEFAULT nextval('pessoas_id_seq'::regclass);
 9   ALTER TABLE public.pessoas ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    179    178            �           2604    23080    id    DEFAULT     f   ALTER TABLE ONLY procedimentos ALTER COLUMN id SET DEFAULT nextval('procedimentos_id_seq'::regclass);
 ?   ALTER TABLE public.procedimentos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            �           2604    22926    id    DEFAULT     X   ALTER TABLE ONLY regras ALTER COLUMN id SET DEFAULT nextval('regras_id_seq'::regclass);
 8   ALTER TABLE public.regras ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    181    180            �           2604    22927    id    DEFAULT     \   ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    183    182            �           2604    22983    id    DEFAULT     \   ALTER TABLE ONLY vinculos ALTER COLUMN id SET DEFAULT nextval('vinculos_id_seq'::regclass);
 :   ALTER TABLE public.vinculos ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    186    187    187            j	          0    23037    cargos 
   TABLE DATA               B   COPY cargos (id, titulo, conta_id, descricao, status) FROM stdin;
    public       postgres    false    193   3v       �	           0    0    cargos_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('cargos_id_seq', 1, false);
            public       postgres    false    192            b	          0    22967    contas 
   TABLE DATA               1   COPY contas (id, titulo, usuario_id) FROM stdin;
    public       postgres    false    185   Pv       �	           0    0    contas_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('contas_id_seq', 1, false);
            public       postgres    false    184            U	          0    22885    departamentos 
   TABLE DATA               Q   COPY departamentos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    172   mv       �	           0    0    departamentos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('departamentos_id_seq', 2, true);
            public       postgres    false    173            l	          0    23051 	   dimensoes 
   TABLE DATA               ?   COPY dimensoes (id, titulo, ano, conta_id, status) FROM stdin;
    public       postgres    false    195   �v       �	           0    0    dimensoes_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('dimensoes_id_seq', 1, true);
            public       postgres    false    194            f	          0    22999    faixas 
   TABLE DATA               X   COPY faixas (id, titulo, limite_vermelho, limite_amarelo, status, conta_id) FROM stdin;
    public       postgres    false    189   �v       �	           0    0    faixas_id_seq    SEQUENCE SET     4   SELECT pg_catalog.setval('faixas_id_seq', 1, true);
            public       postgres    false    188            h	          0    23012    indicadores 
   TABLE DATA               >   COPY indicadores (id, titulo, conta_id, faixa_id) FROM stdin;
    public       postgres    false    191   w       �	           0    0    indicadores_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('indicadores_id_seq', 1, false);
            public       postgres    false    190            W	          0    22891    perfis 
   TABLE DATA               J   COPY perfis (id, titulo, status, created, modified, conta_id) FROM stdin;
    public       postgres    false    174   (w       �	           0    0    perfis_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('perfis_id_seq', 12, true);
            public       postgres    false    175            Y	          0    22897 
   permissoes 
   TABLE DATA               7   COPY permissoes (id, perfil_id, descricao) FROM stdin;
    public       postgres    false    176   �w       �	           0    0    permissoes_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('permissoes_id_seq', 98, true);
            public       postgres    false    177            [	          0    22902    pessoas 
   TABLE DATA               F   COPY pessoas (id, nome, email, created, modified, status) FROM stdin;
    public       postgres    false    178   �x       �	           0    0    pessoas_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('pessoas_id_seq', 1, true);
            public       postgres    false    179            n	          0    23077    procedimentos 
   TABLE DATA               �   COPY procedimentos (id, titulo, resultado_esperado, passo, requisito, arquivo, arquivo_dir, usuario_id, certificado, conta_id, status) FROM stdin;
    public       postgres    false    197   y       �	           0    0    procedimentos_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('procedimentos_id_seq', 1, false);
            public       postgres    false    196            ]	          0    22911    regras 
   TABLE DATA               6   COPY regras (id, permissao_id, descricao) FROM stdin;
    public       postgres    false    180   ;y       �	           0    0    regras_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('regras_id_seq', 196, true);
            public       postgres    false    181            _	          0    22916    usuarios 
   TABLE DATA               �   COPY usuarios (id, login, senha, pessoa_id, perfil_id, created, modified, status, departamento_id, conta_id, vinculo_id) FROM stdin;
    public       postgres    false    182   �{       �	           0    0    usuarios_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('usuarios_id_seq', 1, true);
            public       postgres    false    183            d	          0    22980    vinculos 
   TABLE DATA               L   COPY vinculos (id, titulo, status, conta_id, created, modified) FROM stdin;
    public       postgres    false    187   �{       �	           0    0    vinculos_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('vinculos_id_seq', 1, true);
            public       postgres    false    186            �           2606    23042    cargos_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_pkey;
       public         postgres    false    193    193            �           2606    22972    contas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_pkey;
       public         postgres    false    185    185            �           2606    22929    departamentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.departamentos DROP CONSTRAINT departamentos_pkey;
       public         postgres    false    172    172            �           2606    23056    dimensoes_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_pkey;
       public         postgres    false    195    195            �           2606    23024    faixas_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_pkey;
       public         postgres    false    189    189            �           2606    23017    indicadores_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_pkey;
       public         postgres    false    191    191            �           2606    22931    perfis_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY perfis
    ADD CONSTRAINT perfis_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.perfis DROP CONSTRAINT perfis_pkey;
       public         postgres    false    174    174            �           2606    22933    permissoes_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_pkey;
       public         postgres    false    176    176            �           2606    22935    pessoas_pkey 
   CONSTRAINT     K   ALTER TABLE ONLY pessoas
    ADD CONSTRAINT pessoas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.pessoas DROP CONSTRAINT pessoas_pkey;
       public         postgres    false    178    178            �           2606    23086    procedimentos_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY procedimentos
    ADD CONSTRAINT procedimentos_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.procedimentos DROP CONSTRAINT procedimentos_pkey;
       public         postgres    false    197    197            �           2606    22937    regras_pkey 
   CONSTRAINT     I   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_pkey;
       public         postgres    false    180    180            �           2606    22939    usuarios_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    182    182            �           2606    22986    vinculos_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY vinculos
    ADD CONSTRAINT vinculos_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.vinculos DROP CONSTRAINT vinculos_pkey;
       public         postgres    false    187    187            �           2606    23043    cargos_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.cargos DROP CONSTRAINT cargos_conta_id_fkey;
       public       postgres    false    193    185    2256            �           2606    22973    contas_usuario_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY contas
    ADD CONSTRAINT contas_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES usuarios(id);
 G   ALTER TABLE ONLY public.contas DROP CONSTRAINT contas_usuario_id_fkey;
       public       postgres    false    2254    185    182            �           2606    23057    dimensoes_conta_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY dimensoes
    ADD CONSTRAINT dimensoes_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 K   ALTER TABLE ONLY public.dimensoes DROP CONSTRAINT dimensoes_conta_id_fkey;
       public       postgres    false    185    195    2256            �           2606    23025    faixas_conta_id_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY faixas
    ADD CONSTRAINT faixas_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 E   ALTER TABLE ONLY public.faixas DROP CONSTRAINT faixas_conta_id_fkey;
       public       postgres    false    2256    189    185            �           2606    23018    indicadores_conta_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_conta_id_fkey FOREIGN KEY (conta_id) REFERENCES contas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_conta_id_fkey;
       public       postgres    false    185    2256    191            �           2606    23030    indicadores_faixa_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY indicadores
    ADD CONSTRAINT indicadores_faixa_id_fkey FOREIGN KEY (faixa_id) REFERENCES faixas(id);
 O   ALTER TABLE ONLY public.indicadores DROP CONSTRAINT indicadores_faixa_id_fkey;
       public       postgres    false    191    2260    189            �           2606    22940    permissoes_perfil_id_fkey    FK CONSTRAINT     x   ALTER TABLE ONLY permissoes
    ADD CONSTRAINT permissoes_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 N   ALTER TABLE ONLY public.permissoes DROP CONSTRAINT permissoes_perfil_id_fkey;
       public       postgres    false    2246    176    174            �           2606    22945    regras_permissao_id_fkey    FK CONSTRAINT     z   ALTER TABLE ONLY regras
    ADD CONSTRAINT regras_permissao_id_fkey FOREIGN KEY (permissao_id) REFERENCES permissoes(id);
 I   ALTER TABLE ONLY public.regras DROP CONSTRAINT regras_permissao_id_fkey;
       public       postgres    false    176    180    2248            �           2606    22950    usuarios_departamento_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_departamento_id_fkey FOREIGN KEY (departamento_id) REFERENCES departamentos(id);
 P   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_departamento_id_fkey;
       public       postgres    false    172    182    2244            �           2606    22955    usuarios_perfil_id_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_perfil_id_fkey FOREIGN KEY (perfil_id) REFERENCES perfis(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_perfil_id_fkey;
       public       postgres    false    182    2246    174            �           2606    22960    usuarios_pessoa_id_fkey    FK CONSTRAINT     u   ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pessoa_id_fkey FOREIGN KEY (pessoa_id) REFERENCES pessoas(id);
 J   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pessoa_id_fkey;
       public       postgres    false    178    182    2250            j	      x������ � �      b	      x������ � �      U	   /   x�3�t��K�KN�,��4�� .#ΐ���bCCCN�p� yB�      l	      x�3�,I-"NC#c�?NC�=... N�E      f	   !   x�3�,I-.I�4�30���1~@����� mE9      h	      x������ � �      W	   `   x�3�tO-.�/�4�� .C#N�Ҽ����Ģ�|��������������������V1�^Nǔ�̼�⒢���0�F&
�&V��VFf �1z\\\ ���      Y	   2  x�m�Mn�0��5&�P�-����ȦYuc��D 2 E�Mգ�b��c����,ay�ޏ�o�Ṇ
�ָ4�zi;L�������`.���(��M_��\',9Y�	E��^5#L��6c"	)Q�H 1����1Յ�4P�LIۋq���I�,�2��F��*�͸�\m;D�n(�ݲ�r;_m'�꫁�!��0��b!͢ʱ �
l�P��3����+'A�"I҂�H���������C=�E�*j���yTQ�Eԉ���'�U�����S��F��~Z� wKx��m�-�4M�W      [	   4   x�3�)���WpN,*K����,q�3�2����s���8c�@Ȑ+F��� � �      n	      x������ � �      ]	   _  x�}����0E���,�7Yg�z��J#�J@������Ԑ�Н��ޱ�pDE���󚯷�����z�׷�xǇ���r^~/����f|·w�Z���#�p9��Tj�,�|9-�Ҋ59�[�J����t���4९T ��cYf��RQ�\O�����\֓ ��V��FOJ�=�!�lL)m+ԩRڑ7
���9�틍R:<��鍙I�[���m�2Z�\��0�1el{w���M3~��!��˼��(b�'
S�9;	p�ZEAm��f��q�P��Ƭ�P��:
�@���2������s^����De6�J�0�s]��qf�����V�������eZ����cǱ����q0��뜟���Es=Q�
����í��.���:q��E]`+����h
��9-}ϗ��,.&�9�#��q�7��Y�[�l�o���(��-0n�ᅪa�/I��{X�A���_����n�E��$xH�4U�^!6N�� ,VRu�����0�%]�V#����G�n2D�G(Y�X�G<���y�H�0u]��
���6ޒ�C�]�Ex�.�Z��K���)v�6��U����v8�{z��      _	   @   x�3�,)���O.*�420JN�43JL6�4072M��M�R��M��8�0���,�=... }�      d	   7   x�3�I-.I544�4����4204�50�54Q02�24�24B3�20����� ���     