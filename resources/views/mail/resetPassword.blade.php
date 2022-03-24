<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <style>
        *{box-sizing:border-box;margin:0;padding:0;list-style-type:none;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,'Open Sans','Helvetica Neue',sans-serif;color:#5e5f5f;font-size:14px;text-decoration:none}body{margin:0;padding:0}.mail{width:100%;height:100%;background:#f7f7fc;padding-bottom:50px}.mail-header{background:#fbcf3d;width:100%;height:250px;text-align:center;padding:50px;position:relative}.mail-header img{max-height:80px}.mail-container{max-width:440px;margin:0 auto;position:relative}.mail-context{border-radius:3px;background:#fff;width:100%;margin-top:-100px;padding:30px;box-shadow:0 5px 10px 0 #ccc}.mail-context h3{font-size:2em;font-weight:500;margin-bottom:20px;border-bottom:2px solid #fbcf3d;width:fit-content;margin:0 auto}.mail-context p{margin:15px 0}.mail-context a{color:#fbcf3d}.mail-context-data{background:#f7f7fc;padding:20px;border-radius:3px}.mail-context-data li{margin:5px 0}.mail-context-data strong{color:#fbcf3d;margin-right:10px}.mail-cta{margin:20px 0;background:#fff;padding:20px 10px 30px;border-radius:3px;box-shadow:0 5px 10px 0 #ccc;text-align:center}.mail-cta p{color:#5e5f5f;font-size:1.2em;font-weight:500;margin:0 auto 20px;width:fit-content;border-bottom:2px solid #fbcf3d}.mail-cta a{background:#fbcf3d;padding:10px;border-radius:5px;color:#f7f7fc;margin:20px auto;text-align:center}.mail-cta a:hover{background:#d4a91c}.mail-links{margin:20px 0;color:#ccc}.mail-links a{font-size:.9em;color:#000;text-decoration:underline}.mail-footer{margin:10px 0}.mail-footer small{font-size:12px}.mail-footer p{text-align:center;margin-top:5px;color:#ccc;font-size:12px}
    </style>
</head>
<body class="mail">
    <div class="mail-header">
        <img src="{{asset('storage/formula-ja-white.png')}}" alt="{{config('app.name')}}">
    </div>
    <div class="mail-container">
        <div class="mail-context">
            <h3>Reset de senha!</h3>
            <p>Olá {{ $name }}, você está recebendo este e-mail por que foi solicitado um reset de senha na sua conta!</p>

            <p>Clique <strong><a href="{{$link}}">aqui</a></strong> para resetar a sua senha</p>
            <p>O link irá expirar em 60 minutos.</p>

            <p>Caso não tenha sido você, apenas ignore este e-mail</p>
            <p>Caso tenha alguma dúvida, basta responder este e-mail com sua dúvida e estaremos prontos para te ajudar!</p>

            <p>Se estiver com problemas para clicar no botao de reset de senha, copie e cole este link no seu navegador:</p>

            <a href="{{$link}}">{{$link}}</a>

            <p>
                Atenciosamente, <br />
                Time {{config('app.name')}}
            </p>
        </div>

        <div class="mail-cta">
            <p>Quer enviar sua receita?</p>
            <a href="{{route('guest.receita')}}">Estamos prontos para ajudar!</a>
        </div>

        <div class="mail-links">
            <a href="{{route('guest.receita')}}">Enviar receita</a> |
            <a href="{{route('profile')}}">Perfil</a> |
            <a href="{{route('guest.blog')}}">Blog</a>
        </div>

        <div class="mail-footer">
            <small>{{config('app.name')}} | {{config('app.address.street')}}, {{config('app.address.number')}}, {{config('app.address.neighborhood')}} - {{config('app.address.city')}}/{{config('app.address.state')}} &mdash; {{config('app.cnpj')}}</small>
            <p>{{date('Y')}}</p>
        </div>
    </div>
</body>
</html>
