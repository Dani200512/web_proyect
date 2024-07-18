@extends('layouts.app')

@section('content')
<link href="{{ asset('css/create_posts.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card">
        <h1 class="form-title">Crear nueva publicación</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="linkedin-form">
            @csrf
            <div class="form-group">
                <label for="publication_type">Tipo de publicación</label>
                <select class="form-control" id="publication_type" name="publication_type" required>
                    <option value="general">Publicación general</option>
                    <option value="job_offer">Oferta de trabajo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="content">Contenido adicional</label>
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>

            <div id="job_offer_fields" style="display: none;">
                <h3>Detalles de la oferta de trabajo</h3>
                <div class="form-group">
                    <label for="job_offer_title">Título de la oferta</label>
                    <input type="text" class="form-control" id="job_offer_title" name="job_offer[title]">
                </div>
                <div class="form-group">
                    <label for="job_offer_description">Descripción de la oferta</label>
                    <textarea class="form-control" id="job_offer_description" name="job_offer[description]"></textarea>
                </div>
                <div class="form-group">
                    <label for="job_offer_requirements">Requisitos</label>
                    <textarea class="form-control" id="job_offer_requirements" name="job_offer[requirements]"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="photo">Foto (opcional)</label>
                <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
            </div>

            <div class="form-group">
                <label for="video">Video (opcional)</label>
                <input type="file" class="form-control-file" id="video" name="video" accept="video/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="linkedin-btn btn-primary">Crear publicación</button>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('publication_type').addEventListener('change', function() {
    var jobOfferFields = document.getElementById('job_offer_fields');
    if (this.value === 'job_offer') {
        jobOfferFields.style.display = 'block';
    } else {
        jobOfferFields.style.display = 'none';
    }
});
</script>
@endsection
