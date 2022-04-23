@if ($file->mime_type == 'audio/mpeg')
    <audio controls>
        <source src="{{ $file->original_url }}" type="{{ $file->mime_type }}">
    </audio>
@elseif ($file->mime_type == 'video/mp4')
    <iframe src="{{ $file->original_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
@elseif ($file->mime_type == 'application/pdf')
    <iframe src="{{ $file->original_url }}" width="100%" height="600px"></iframe>
@endif
