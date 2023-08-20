<div class="position-relative bg-light p-3 rounded shadow-sm mb-3 section">
    <div>
        <div class="position-absolute top-0 end-0 btn btn-danger btn-sm rounded-0 border-bottom-start-rounded delete-section">
            <i class="fa-solid fa-trash"></i>
        </div>
        <label for="section_title" class="form-label">Titre de la section</label>
        <input type="text" class="form-control" name="section_title" id="section_title"
        value="{{ $title ?? '' }}" required>
    </div>
    <div class="mt-3">
        <label class="form-label">Section</label>
        <textarea class="tinyMce basic" name="context">
            {{ $content ?? '' }}
        </textarea>
    </div>
    
</div>