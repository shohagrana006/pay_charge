
<div class="modal fade" id="show-permission-{{ $role->id }}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="language-modal-title"> {{ $role->name }} Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                <div class="row">
                    @forelse($role->permissions as $permission)
                        <div class="mb-3 col-12 col-lg-4 p-2 border">
                            <span>{{ $permission->name }}</span>
                        </div>
                    @empty
                      'N/A'
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
