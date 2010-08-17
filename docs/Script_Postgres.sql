
CREATE SEQUENCE public.groups_id_seq;

CREATE TABLE public.groups (
                id INTEGER NOT NULL DEFAULT nextval('public.groups_id_seq'),
                name VARCHAR(50) NOT NULL,
                created DATE NOT NULL,
                modified DATE NOT NULL,
                CONSTRAINT groups_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.groups_id_seq OWNED BY public.groups.id;

CREATE TABLE public.users (
                id INTEGER NOT NULL,
                password VARCHAR(50) NOT NULL,
                group_id INTEGER NOT NULL,
                username VARCHAR(255) NOT NULL,
                created DATE NOT NULL,
                modified DATE NOT NULL,
                CONSTRAINT users_pk PRIMARY KEY (id)
);


CREATE SEQUENCE public.bancos_id_seq;

CREATE TABLE public.bancos (
                id INTEGER NOT NULL DEFAULT nextval('public.bancos_id_seq'),
                nome VARCHAR(100) NOT NULL,
                codigo_compensacao VARCHAR(10) NOT NULL,
                imagem VARCHAR(200) NOT NULL,
                CONSTRAINT bancos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.bancos_id_seq OWNED BY public.bancos.id;

CREATE SEQUENCE public.bloquetos_id_seq;

CREATE TABLE public.bloquetos (
                id INTEGER NOT NULL DEFAULT nextval('public.bloquetos_id_seq'),
                banco_id INTEGER NOT NULL,
                local_pagamento VARCHAR(150) NOT NULL,
                carteira VARCHAR(10) NOT NULL,
                tipo VARCHAR(70) NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT bloquetos_pk PRIMARY KEY (id)
);
COMMENT ON COLUMN public.bloquetos.tipo IS 'Podem ser eles: COBRANÇA REGISTRADA ou COBRANÇA NÃO REGISTRADA ';


ALTER SEQUENCE public.bloquetos_id_seq OWNED BY public.bloquetos.id;

CREATE SEQUENCE public.agencias_id_seq;

CREATE TABLE public.agencias (
                id INTEGER NOT NULL DEFAULT nextval('public.agencias_id_seq'),
                codigo VARCHAR(10) NOT NULL,
                codigo_cedente VARCHAR(50) NOT NULL,
                logradouro VARCHAR(300),
                bairro VARCHAR(50),
                telefone VARCHAR(17),
                banco_id INTEGER NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT agencias_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.agencias_id_seq OWNED BY public.agencias.id;

CREATE SEQUENCE public.situacoes_id_seq;

CREATE TABLE public.situacoes (
                id INTEGER NOT NULL DEFAULT nextval('public.situacoes_id_seq'),
                nome VARCHAR(50) NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT situacoes_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.situacoes_id_seq OWNED BY public.situacoes.id;

CREATE SEQUENCE public.pedidos_id_seq;

CREATE TABLE public.pedidos (
                id INTEGER NOT NULL DEFAULT nextval('public.pedidos_id_seq'),
                created TIMESTAMP NOT NULL,
                numero INTEGER NOT NULL,
                CONSTRAINT pedidos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.pedidos_id_seq OWNED BY public.pedidos.id;

CREATE SEQUENCE public.situacao_pedidos_id_seq;

CREATE TABLE public.situacao_pedidos (
                id INTEGER NOT NULL DEFAULT nextval('public.situacao_pedidos_id_seq'),
                pedido_id INTEGER NOT NULL,
                data TIMESTAMP NOT NULL,
                situacao_id INTEGER NOT NULL,
                CONSTRAINT situacao_pedidos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.situacao_pedidos_id_seq OWNED BY public.situacao_pedidos.id;

CREATE SEQUENCE public.estados_id_seq;

CREATE TABLE public.estados (
                id INTEGER NOT NULL DEFAULT nextval('public.estados_id_seq'),
                nome VARCHAR(100) NOT NULL,
                CONSTRAINT estados_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.estados_id_seq OWNED BY public.estados.id;

CREATE SEQUENCE public.cores_id_seq;

CREATE TABLE public.cores (
                id INTEGER NOT NULL DEFAULT nextval('public.cores_id_seq'),
                nome VARCHAR(100) NOT NULL,
                diretorio VARCHAR(200) NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT cores_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.cores_id_seq OWNED BY public.cores.id;

CREATE SEQUENCE public.grupos_id_seq;

CREATE TABLE public.grupos (
                id INTEGER NOT NULL DEFAULT nextval('public.grupos_id_seq'),
                nome VARCHAR(100) NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT grupos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.grupos_id_seq OWNED BY public.grupos.id;

CREATE SEQUENCE public.produtos_id_seq;

CREATE TABLE public.produtos (
                id INTEGER NOT NULL DEFAULT nextval('public.produtos_id_seq'),
                codigo INTEGER NOT NULL,
                descricao VARCHAR(100) NOT NULL,
                grupo_id INTEGER NOT NULL,
                pacote INTEGER NOT NULL,
                caixa INTEGER NOT NULL,
                peso_bruto NUMERIC(10,0) NOT NULL,
                peso_liquido NUMERIC(10,0) NOT NULL,
                cubagem NUMERIC(10,5) NOT NULL,
                preco NUMERIC(10,2) NOT NULL,
                obs TEXT NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT produtos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.produtos_id_seq OWNED BY public.produtos.id;

CREATE TABLE public.itens (
                id INTEGER NOT NULL,
                produto_id INTEGER NOT NULL,
                codigo VARCHAR(10) NOT NULL,
                titulo VARCHAR(100) NOT NULL,
                metragem DOUBLE PRECISION,
                cor_id INTEGER NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT itens_pk PRIMARY KEY (id)
);


CREATE SEQUENCE public.itens_pedidos_id_seq;

CREATE TABLE public.itens_pedidos (
                id INTEGER NOT NULL DEFAULT nextval('public.itens_pedidos_id_seq'),
                pedido_id INTEGER NOT NULL,
                produto_id INTEGER NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT itens_pedidos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.itens_pedidos_id_seq OWNED BY public.itens_pedidos.id;

CREATE SEQUENCE public.imagens_id_seq;

CREATE TABLE public.imagens (
                id INTEGER NOT NULL DEFAULT nextval('public.imagens_id_seq'),
                produto_id INTEGER NOT NULL,
                nome VARCHAR(70) NOT NULL,
                diretorio VARCHAR(150) NOT NULL,
                tamanho_arquivo VARCHAR(20) NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT imagens_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.imagens_id_seq OWNED BY public.imagens.id;

CREATE TABLE public.clientes (
                id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                telefone VARCHAR(17) NOT NULL,
                email VARCHAR(70) NOT NULL,
                logradouro VARCHAR(150) NOT NULL,
                cep VARCHAR(9) NOT NULL,
                bairro VARCHAR(45) NOT NULL,
                cidade VARCHAR(50) NOT NULL,
                estado_id INTEGER NOT NULL,
                ativo BOOLEAN NOT NULL,
                CONSTRAINT clientes_pk PRIMARY KEY (id)
);


CREATE SEQUENCE public.cedentes_id_seq;

CREATE TABLE public.cedentes (
                id INTEGER NOT NULL DEFAULT nextval('public.cedentes_id_seq'),
                conta_corrente VARCHAR(10) NOT NULL,
                cliente_id INTEGER NOT NULL,
                agencia_id INTEGER NOT NULL,
                bloqueto_id INTEGER NOT NULL,
                CONSTRAINT cedentes_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.cedentes_id_seq OWNED BY public.cedentes.id;

CREATE SEQUENCE public.boletos_id_seq;

CREATE TABLE public.boletos (
                id INTEGER NOT NULL DEFAULT nextval('public.boletos_id_seq'),
                numero VARCHAR(70) NOT NULL,
                nosso_numero VARCHAR(70) NOT NULL,
                emissao DATE NOT NULL,
                status VARCHAR(10) NOT NULL,
                vencimento DATE NOT NULL,
                cedente_id INTEGER NOT NULL,
                cliente_id INTEGER NOT NULL,
                valor NUMERIC(10,2) NOT NULL,
                CONSTRAINT boletos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.boletos_id_seq OWNED BY public.boletos.id;

CREATE SEQUENCE public.vendas_id_seq;

CREATE TABLE public.vendas (
                id INTEGER NOT NULL DEFAULT nextval('public.vendas_id_seq'),
                created TIMESTAMP NOT NULL,
                pedido_id INTEGER NOT NULL,
                situacao_id INTEGER NOT NULL,
                boleto_id INTEGER NOT NULL,
                CONSTRAINT vendas_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.vendas_id_seq OWNED BY public.vendas.id;

CREATE SEQUENCE public.cliente_pedidos_id_seq;

CREATE TABLE public.cliente_pedidos (
                id INTEGER NOT NULL DEFAULT nextval('public.cliente_pedidos_id_seq'),
                cliente_id INTEGER NOT NULL,
                pedido_id INTEGER NOT NULL,
                CONSTRAINT cliente_pedidos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.cliente_pedidos_id_seq OWNED BY public.cliente_pedidos.id;

CREATE SEQUENCE public.cliente_juridicos_id_seq;

CREATE TABLE public.cliente_juridicos (
                id INTEGER NOT NULL DEFAULT nextval('public.cliente_juridicos_id_seq'),
                cliente_id INTEGER NOT NULL,
                nome_fantasia VARCHAR(70) NOT NULL,
                razao_social VARCHAR(70) NOT NULL,
                cnpj VARCHAR(15) NOT NULL,
                CONSTRAINT cliente_juridicos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.cliente_juridicos_id_seq OWNED BY public.cliente_juridicos.id;

CREATE SEQUENCE public.cliente_fisicos_id_seq;

CREATE TABLE public.cliente_fisicos (
                id INTEGER NOT NULL DEFAULT nextval('public.cliente_fisicos_id_seq'),
                cliente_id INTEGER NOT NULL,
                nome VARCHAR(50) NOT NULL,
                cpf VARCHAR(15) NOT NULL,
                CONSTRAINT cliente_fisicos_pk PRIMARY KEY (id)
);


ALTER SEQUENCE public.cliente_fisicos_id_seq OWNED BY public.cliente_fisicos.id;

ALTER TABLE public.users ADD CONSTRAINT groups_users_fk
FOREIGN KEY (group_id)
REFERENCES public.groups (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.clientes ADD CONSTRAINT users_clientes_fk
FOREIGN KEY (user_id)
REFERENCES public.users (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.agencias ADD CONSTRAINT bancos_agencias_fk
FOREIGN KEY (banco_id)
REFERENCES public.bancos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.bloquetos ADD CONSTRAINT bancos_bloquetos_fk
FOREIGN KEY (banco_id)
REFERENCES public.bancos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cedentes ADD CONSTRAINT bloquetos_cedentes_fk
FOREIGN KEY (bloqueto_id)
REFERENCES public.bloquetos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cedentes ADD CONSTRAINT agencias_cedentes_fk
FOREIGN KEY (agencia_id)
REFERENCES public.agencias (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.situacao_pedidos ADD CONSTRAINT situacoes_status_pedidos_fk
FOREIGN KEY (situacao_id)
REFERENCES public.situacoes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.vendas ADD CONSTRAINT situacoes_vendas_fk
FOREIGN KEY (situacao_id)
REFERENCES public.situacoes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.itens_pedidos ADD CONSTRAINT pedidos_itens_pedidos_fk
FOREIGN KEY (pedido_id)
REFERENCES public.pedidos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.vendas ADD CONSTRAINT pedidos_vendas_fk
FOREIGN KEY (pedido_id)
REFERENCES public.pedidos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cliente_pedidos ADD CONSTRAINT pedidos_cliente_pedidos_fk
FOREIGN KEY (pedido_id)
REFERENCES public.pedidos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.situacao_pedidos ADD CONSTRAINT pedidos_status_pedidos_fk
FOREIGN KEY (id)
REFERENCES public.pedidos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.clientes ADD CONSTRAINT estados_clientes_fk
FOREIGN KEY (estado_id)
REFERENCES public.estados (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.itens ADD CONSTRAINT cores_itens_fk
FOREIGN KEY (cor_id)
REFERENCES public.cores (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.produtos ADD CONSTRAINT grupos_produtos_fk
FOREIGN KEY (grupo_id)
REFERENCES public.grupos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.imagens ADD CONSTRAINT produtos_imagens_fk
FOREIGN KEY (produto_id)
REFERENCES public.produtos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.itens_pedidos ADD CONSTRAINT produtos_itens_pedidos_fk
FOREIGN KEY (produto_id)
REFERENCES public.produtos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.itens ADD CONSTRAINT produtos_itens_fk
FOREIGN KEY (produto_id)
REFERENCES public.produtos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cliente_fisicos ADD CONSTRAINT clientes_cliente_fisicos_fk
FOREIGN KEY (cliente_id)
REFERENCES public.clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cliente_juridicos ADD CONSTRAINT clientes_cliente_juridicos_fk
FOREIGN KEY (cliente_id)
REFERENCES public.clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cliente_pedidos ADD CONSTRAINT clientes_cliente_pedidos_fk
FOREIGN KEY (cliente_id)
REFERENCES public.clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cedentes ADD CONSTRAINT clientes_cedentes_fk
FOREIGN KEY (cliente_id)
REFERENCES public.clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.boletos ADD CONSTRAINT clientes_boletos_fk
FOREIGN KEY (cliente_id)
REFERENCES public.clientes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.boletos ADD CONSTRAINT cedentes_boletos_fk
FOREIGN KEY (cedente_id)
REFERENCES public.cedentes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.vendas ADD CONSTRAINT boletos_vendas_fk
FOREIGN KEY (boleto_id)
REFERENCES public.boletos (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;