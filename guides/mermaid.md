erDiagram

  Usuario ||--o{ Campanha : "cria"
  Usuario ||--o{ Participacao : "participa"
  Usuario ||--o{ ValidacaoMeta : "valida"
  Usuario ||--o{ Pagamento : "recebe"

  Campanha ||--o{ Participacao : "tem"
  Campanha ||--o{ ValidacaoMeta : "gera"
  Campanha ||--o{ Pagamento : "distribui"

  Participacao ||--|| ValidacaoMeta : "é validada por"
  Participacao ||--|| Pagamento : "é paga por"

  Usuario {
    Int id
    String nome
    String email
    CargoUsuario cargo
    String senhaHash
  }

  Campanha {
    Int id
    String titulo
    String descricaoMeta
    TipoCampanha tipo
    Float valorPremio
    DateTime dataInicio
    DateTime dataFim
    Boolean recorrente
    Boolean ativa
  }

  Participacao {
    Int id
    Boolean metaCumprida
    DateTime dataParticipacao
  }

  ValidacaoMeta {
    Int id
    Boolean aprovado
    String observacao
    DateTime dataValidacao
  }

  Pagamento {
    Int id
    Float valorPago
    MetodoPagamento metodo
    StatusPagamento status
    DateTime dataPagamento
  }
