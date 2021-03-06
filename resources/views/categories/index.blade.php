@extends('master')

@section('specific_page_scripts')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection

@section('content')

<div class="categories">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <h1 id="categories">Blog Categories</h1>
            </div>
            @auth
                <div class="col-sm-3 title-right">
                    <button type="submit" class="btn btn-5" name="add-category-button" id="add-category-button">
                        Add Category +
                    </button>
                </div>
            @endauth
            @if($categories->isEmpty())
                <h1 class="no-cats">There is no Categories at the moment</h1>
            @endif
        </div>
        <div class="row">
            @auth
            <div class="col-md-3 col-sm-4  my-5 card-new">
                <div class="card card-body bg-light" id="card-0">
                    <form method="post" action="{{ url('/admin/dashboard/categories') }}" id="add-category-form">
                        @csrf
                        <input type="text" name="category-name" id="category-id" placeholder="name Max(20)" maxlength="20" required>
                        <div class="validation-errors" id="validation-errors-0"></div>
                        <div class="form1">
                            <button type="submit" class="btn btn-primary" id="save-button-0">
                                Save
                            </button>
                        </div>
                    </form>
                    <button class="btn btn-primary" id="cancel-button-0">
                        Cancel
                    </button>
                </div>
            </div>
            @endauth
            @if(!$categories->isEmpty())
                @foreach($categories as $category)
                    <div class="col-md-3 col-sm-4  my-5">
                        <div class="card card-body bg-light" id="card-{{ $category->id }}">
                            <h2> {{ $category->name }} </h2>
                            @auth
                            <div class="edit-form">
                                <form method="post" action="{{ url('/admin/dashboard/categories/'.$category->id) }}"
                                      class="edit-category-form" id="edit-category-form-{{$category->id}}">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="form1">
                                        <div class="validation-errors" id="validation-errors-{{ $category->id }}"></div>
                                        <div class="choice" id="choice-{{ $category->id }}">
                                            <button type="submit" class="btn btn-primary save-button" id="save-button-{{ $category->id }}">
                                                Save
                                            </button>

                                            <button type="button" class="btn btn-primary cancel-button" id="cancel-button-{{ $category->id }}">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <button class="btn btn-primary" id="edit-button-{{ $category->id }}">
                                    Edit
                                </button>
                            </div>
                            <div class="form2">
                                <form method="post" action="{{ url('/admin/dashboard/categories/'.$category->id) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
