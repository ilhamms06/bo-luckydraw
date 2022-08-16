<td>
  <a href="{{ route('project.show', $model->id) }}" class="btn btn-sm btn-secondary">View</a>
  <a href="{{ route('project.edit',$model->id) }}" class="btn btn-sm btn-primary">Update</a>
  <form action="{{ route('project.destroy', $model->id) }}" method="POST" class="d-inline">
    @method('delete')
    @csrf
    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda ingin menghapus data?')">Delete</button>
  </form>
</td>