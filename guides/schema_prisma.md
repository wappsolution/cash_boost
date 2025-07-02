generator client {
  provider = "prisma-client-js"
}

datasource db {
  provider = "postgresql" // ou "mysql"
  url      = env("DATABASE_URL")
}

model Usuario {
  id            Int        @id @default(autoincrement())
  nome          String
  email         String     @unique
  cargo         CargoUsuario
  senhaHash     String
  criadoEm      DateTime   @default(now())
  campanhasCriadas   Campanha[]     @relation("CriadorCampanha")
  validacoes    ValidacaoMeta[]
  participacoes Participacao[]
  pagamentos    Pagamento[]

  @@map("usuarios")
}

enum CargoUsuario {
  ADMIN
  FINANCEIRO
  SUPERVISOR
}

model Campanha {
  id            Int           @id @default(autoincrement())
  titulo        String
  descricaoMeta String
  tipo          TipoCampanha
  valorPremio   Float
  dataInicio    DateTime
  dataFim       DateTime
  recorrente    Boolean       @default(false)
  ativa         Boolean       @default(true)
  criadaPorId   Int
  criadaPor     Usuario       @relation("CriadorCampanha", fields: [criadaPorId], references: [id])
  participacoes Participacao[]
  validacoes    ValidacaoMeta[]
  pagamentos    Pagamento[]
  orcamento     Float?        // opcional: limite de gasto

  criadoEm      DateTime      @default(now())
  atualizadoEm  DateTime      @updatedAt

  @@map("campanhas")
}

enum TipoCampanha {
  PONTUALIDADE
  PREVENTIVA
  URGENTE
}

model Participacao {
  id            Int       @id @default(autoincrement())
  usuarioId     Int
  campanhaId    Int
  dataParticipacao DateTime @default(now())
  metaCumprida  Boolean   @default(false)
  usuario       Usuario   @relation(fields: [usuarioId], references: [id])
  campanha      Campanha  @relation(fields: [campanhaId], references: [id])
  validacao     ValidacaoMeta?
  pagamento     Pagamento?

  @@unique([usuarioId, campanhaId]) // Um funcionário só participa uma vez por campanha
  @@map("participacoes")
}

model ValidacaoMeta {
  id            Int       @id @default(autoincrement())
  participacaoId Int      @unique
  supervisorId  Int
  aprovado      Boolean
  observacao    String?
  dataValidacao DateTime  @default(now())

  participacao  Participacao @relation(fields: [participacaoId], references: [id])
  supervisor    Usuario      @relation(fields: [supervisorId], references: [id])

  @@map("validacoes_meta")
}

model Pagamento {
  id             Int       @id @default(autoincrement())
  participacaoId Int       @unique
  valorPago      Float
  metodo         MetodoPagamento
  status         StatusPagamento
  dataPagamento  DateTime?
  referenciaExterna String? // ID do Pix, cartão, etc.

  participacao   Participacao @relation(fields: [participacaoId], references: [id])

  @@map("pagamentos")
}

enum MetodoPagamento {
  PIX
  CARTAO_PRESENTE
  PLATAFORMA_CREDITO
}

enum StatusPagamento {
  PENDENTE
  PROCESSANDO
  PAGO
  FALHOU
}
