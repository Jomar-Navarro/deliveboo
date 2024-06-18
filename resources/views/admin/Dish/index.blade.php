@extends('layouts.admin')

@section('content')
    <div class="container mt-5 overflow-auto">
        <h1>My dish</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div>


                                    <a href="{{ route('admin.dish.show', $item) }}" class="btn btn-outline-success m-2">
                                        <i class="fa-solid fa-eye "></i></a>
                                    <a href="{{ route('admin.dish.edit', $item) }}" class="btn btn-outline-warning m-2">
                                        <i class="fa-solid fa-pen-nib "></i></a>

                                    @if ($item->trashed())
                                        <form action="{{ route('admin.dish.restore', $item->id) }}" method="POST"
                                            class="m-2">
                                            @csrf
                                            <button type="submit" class="btn btn-warning ">Ripristina</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.dish.destroy', $item->id) }}" method="POST"
                                            class="m-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
