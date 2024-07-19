<mails.layout title="Confirmação de conta">
    <div class="heading">
        CONFIRME SUA CONTA
    </div>

    <div class="subheading">
        Bem-vindo! Para completar o processo de criação da sua conta, por favor use o código abaixo para confirmar seu endereço de e-mail
    </div>

    <mails.partials.button
        token="{{ $token }}"
    />
</mails.layout>
