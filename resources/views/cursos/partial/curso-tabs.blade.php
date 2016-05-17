<div class="container">
    <ul class="nav nav-tabs">
        <li role="presentation" @if($indice == "curso") class="active" @endif ><a href="curso-cadastro">Curso</a></li>
        <li role="presentation" @if($indice == "video") class="active" @endif ><a href="curso-cadastro-video">Vídeos</a></li>
        <li role="presentation" @if($indice == "material") class="active" @endif ><a href="curso-cadastro-material">Material Didático</a></li>
        <li role="presentation" @if($indice == "atividade") class="active" @endif ><a href="curso-cadastro-atividade">Atividades</a></li>
    </ul>
</div>