<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('إضافــة طــالب جديــد') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">


                        <div class = "container">
                            <form action="{{route('student_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">: {{ __('الأســم') }}</label>
                                        <input id="name" type="text" name="name" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone">: {{ __('رقــم التليفـــون') }}</label>
                                        <input id="phone" type="number" name="phone" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="group">: {{ __('المجموعــة') }}</label>
                                        <select class="custom-select mr-sm-2" id="group" name="group">
                                            <option selected>اختر المجموعــة</option>
                                            @foreach($groups as $group)
                                                <option  value={{$group->id}}>{{$group->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-6">
                                        <label for="grade">: {{ __('المرحـــلة الدراسيـــة') }}</label>
                                        <select class="custom-select mr-sm-2" id="grade" name="grade">
                                            <option> اختر المرحـــلة الدراسيـــة</option>
                                            @foreach($grades as $grade)
                                                <option  value={{$grade->id}}>{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="parent">: {{ __('أســــم ولـــي الأمـــر') }}</label>
                                        <input id="parent" type="text" name="parent" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="p_phone">: {{ __('رقــم تليفـــون ولـــي الأمـــر') }}</label>
                                        <input id="p_phone" type="number" name="p_phone" class="form-control">
                                    </div>
                                </div>
                                <br>


                                <div class="modal-footer">
                                    <a href="{{route('students')}}">
                                        <button type="button" class="btn btn-outline-secondary">
                                            {{ trans('الرجـــوع') }}
                                        </button>
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary">
                                        {{ trans('تــــــأكيد') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>


</x-app-layout>
