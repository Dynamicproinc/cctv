<div>
   <div class="container">
    <div class="py-5">

 
                @foreach ($questions as $qIndex => $question)
                    <div class="mb-3 ">
                        <div class="rounded-4 bg-light border shadow-sm">

                            <!-- Header -->
                            <div class="p-4 border-bottom">
                                <h5 class="fw-bold mb-1">
                                    {{ $question->title }}
                                </h5>
                                <p class="text-muted small mb-2">
                                    {{ $question->description }}
                                </p>
                                <a href="#" class="small text-decoration-none">
                                    {{ __('Learn more') }}
                                </a>
                            </div>

                            <!-- Options -->
                            <div class="list-group list-group-flush">
                                @foreach ($question->options as $option)
                                    <label class="list-group-item d-flex align-items-center gap-3 py-3 cursor-pointer">

                                        <input class="form-check-input m-0" type="{{ $question->type }}"
                                            name="question_{{ $question->id }}"
                                            @if ($question->type === 'radio') wire:model.live="answers.{{ $question->id }}"
                                value="{{ $option->id }}"
                                @else
                                wire:model.live="answers.{{ $question->id }}.{{ $option->id }}"
                                value="{{ $option->id }}" @endif
                                            id="option-{{ $question->id }}-{{ $option->id }}">

                                        <div>
                                            <div class="fw-semibold">{{ $option->option_name }}</div>
                                            <small class="text-muted">{{ $option->description }}</small>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="p-3 bg-white rounded-4"></div>
                        </div>
                        {{-- Validation message --}}
                        @error('answers.' . $question->id)
                            <div class="alert alert-danger mx-3 mt-2 py-2">
                                {{ __('An answer is required for this question') }}
                            </div>
                        @enderror
                    </div>
                @endforeach


                {{-- --}}
                <div>
                    @foreach ($multiple_choices as $qIndex => $mc)
                        <div class="mb-3 ">
                            <div class="rounded-4 bg-light border shadow-sm">

                                <!-- Header -->
                                <div class="p-4 border-bottom">
                                    <h5 class="fw-bold mb-1">
                                        {{ $mc->title }}
                                    </h5>
                                    <p class="text-muted small mb-2">
                                        {{ $mc->description }}
                                    </p>
                                    <a href="#" class="small text-decoration-none">
                                        {{ __('Learn more') }}
                                    </a>
                                </div>

                                <!-- Options -->
                                <div class="list-group list-group-flush">
                                    @foreach ($mc->options as $option)
                                        <label
                                            class="list-group-item d-flex align-items-center gap-3 py-3 cursor-pointer">

                                            <input class="form-check-input m-0" type="{{ $mc->type }}"
                                                name="mc_{{ $mc->id }}"
                                                wire:model.live="m_choices.{{ $mc->id }}.{{ $option->id }}"
                                                value="{{ $option->id }}"
                                                id="option-{{ $mc->id }}-{{ $option->id }}">

                                            <div>
                                                <div class="fw-semibold">{{ $option->option_name }}</div>
                                                <small class="text-muted">{{ $option->description }}</small>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="p-3 bg-white rounded-4"></div>
                            </div>
                            {{-- Validation message --}}
                            @error('m_choices.' . $mc->id)
                                <div class="alert alert-danger mx-3 mt-2 py-2">
                                    {{ __('An answer is required for this question') }}
                                </div>
                            @enderror
                        </div>
                    @endforeach

                </div>
                {{-- --}}




                <div class="fixed-bottom">
                    {{-- <p class="small">{{ __('Press Continue to proceed to the next step of the solution.') }}</p> --}}
                    <button class="btn btn-dark w-100 btn-lg rounded-0" wire:click="save" wire:loading.attr="disabled">
                        <span class="spinner-border spinner-border-sm" role="status" wire:loading wire:target="save">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                        {{ __('Finalize') }}
                    </button>
                    {{-- @if (session()->has('error'))
                    <div class="alert alert-danger mt-3">
                        error
                    </div>
                    @endif --}}
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <p>{{ __('Please make sure to answer all required questions.') }}</p>
                        </div>
                    @endif --}}
                </div>
            </div>
   </div>
</div>
