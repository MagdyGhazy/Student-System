<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('جميــع الطــــلاب') }}
        </h2>
    </x-slot>

    <div class="py-12" style="direction:rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class = "container">

                        <div class="row">

                            <div class="col-xl-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <a href="{{route('student_create')}}">
                                            <button type="button" class="btn btn-outline-success" >
                                                {{ __('إضافة طــالب') }}
                                            </button>
                                        </a>



                                        <br><br>

                                        <div>
                                            <table id="datatable" class="table align-middle  table-hover table-sm table-bordered p-0"
                                                   data-page-length="50"
                                                   style="text-align: center ; align-content: center">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__('الأســـم')}}</th>
                                                    <th>{{__('المرحـــــلة الدراسيــــة')}}</th>
                                                    <th>{{__('المجمـــــوعة')}}</th>
                                                    <th>{{__('عمليــــات')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($students as $student)
                                                    <tr>

                                                            <?php $i++; ?>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $student->name }}</td>
                                                        <td>{{ $student->grade->name }}</td>
                                                        <td>{{ $student->group->name }}</td>
                                                        <td>
                                                            <a href="{{ route('student_edit', ['id' => $student->id]) }}"><button type="button" class="btn btn-outline-info btn-sm">{{ __('تعـديل') }}</button></a>
                                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $student->id }}">{{ __('حــذف') }}</button>
                                                        </td>
                                                    </tr>


                                                    <!-- delete_modal_Student -->
                                                    <div class="modal fade" id="delete{{ $student->id }}" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                        id="exampleModalLabel">
                                                                        {{ trans('حــــــذف') }}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{route('student_delete')}}" method="post">
                                                                        @csrf
                                                                        {{ trans('هــل انـــت متـــاكد مــن الحــــذف ؟ ') }}
                                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                                               value="{{ $student->id }}">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-outline-secondary"
                                                                                    data-dismiss="modal">{{ __('إغـــلاق') }}
                                                                            </button>
                                                                            <button type="submit"
                                                                                    class="btn btn-outline-danger">{{ __('حـــــذف') }}
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
