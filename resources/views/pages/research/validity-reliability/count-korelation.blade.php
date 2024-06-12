<div class="d-flex flex-wrap">
    @foreach ($data['sigma_x'] as $index => $dt)
        <div class="col-md-6 col-12">
            <div class="mx-md-3 mx-2 my-2 border border-white p-md-3 p-2 rounded">
                <div>
                    r <sub>value/count 1</sub> ( Correlation 1 / R1 )<br />
                    <hr>
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ $data['n'] }} ( {{ $data['sigma_xy'][$index] }} ) - ( {{ $data['sigma_x'][$index] }} ) ( {{ $data['sigma_y'] }} )
                                        </mi>
                                    </mrow>
                                    <mrow>
                                        <msqrt class="mt-2">
                                            <mrow class="mt-2 mx-2">
                                                <mi>
                                                    ( {{ $data['n'] }} ( {{ $data['sigma_xx'][$index] }} ) - ( {{ $data['sigmax_sigmax'][$index] }} ) ) &nbsp;&nbsp; ( {{ $data['n'] }} ( {{ $data['sigma_yy'] }} ) - ( {{ $data['sigmay_sigmay'] }} ) )
                                                </mi>
                                            </mrow>
                                        </msqrt>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) }} - {{ doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) }}
                                        </mi>
                                    </mrow>
                                    <mrow>
                                        <msqrt class="mt-2">
                                            <mrow class="mt-2 mx-2">
                                                <mi>
                                                    ( {{ doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) }} - {{ $data['sigmax_sigmax'][$index] }} ) &nbsp;&nbsp; ( {{ doubleval($data['n']) * doubleval($data['sigma_yy']) }} - {{ $data['sigmay_sigmay'] }} )
                                                </mi>
                                            </mrow>
                                        </msqrt>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ ( doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) ) - ( doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) ) }}
                                        </mi>
                                    </mrow>
                                    <mrow>
                                        <msqrt class="mt-2">
                                            <mrow class="mt-2 mx-2">
                                                <mi>
                                                    ( {{ ( doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) ) - doubleval($data['sigmax_sigmax'][$index]) }} ) &nbsp; ( {{(  doubleval($data['n']) * doubleval($data['sigma_yy']) ) - doubleval($data['sigmay_sigmay']) }} )
                                                </mi>
                                            </mrow>
                                        </msqrt>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ ( doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) ) - ( doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) ) }}
                                        </mi>
                                    </mrow>
                                    <mrow>
                                        <msqrt class="mt-2">
                                            <mrow class="mt-2 mx-2">
                                                <mi>
                                                    {{ ( ( doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) ) - doubleval($data['sigmax_sigmax'][$index]) ) * ( ( doubleval($data['n']) * doubleval($data['sigma_yy']) ) - doubleval($data['sigmay_sigmay']) ) }}
                                                </mi>
                                            </mrow>
                                        </msqrt>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ ( doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) ) - ( doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) ) }}
                                        </mi>
                                    </mrow>
                                    <mrow>
                                        <mrow class="mt-2 mx-2">
                                            <mi>
                                                {{ sqrt(( ( doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) ) - doubleval($data['sigmax_sigmax'][$index]) ) * ( ( doubleval($data['n']) * doubleval($data['sigma_yy']) ) - doubleval($data['sigmay_sigmay']) )) }}
                                            </mi>
                                        </mrow>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <mi>r</mi>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow>
                                        <mi class="mb-2">
                                            {{ number_format( ( ( doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) ) - ( doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) ) ) / (sqrt(( ( doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) ) - doubleval($data['sigmax_sigmax'][$index]) ) * ( ( doubleval($data['n']) * doubleval($data['sigma_yy']) ) - doubleval($data['sigmay_sigmay']) ))), 4, ',', '' ) }}
                                        </mi>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                </div>
                <div class="bg-secondary p-2 mt-3 rounded">
                    @php
                        $r_count = ( ( doubleval($data['n']) * doubleval($data['sigma_xy'][$index]) ) - ( doubleval($data['sigma_x'][$index]) * doubleval($data['sigma_y']) ) ) / (sqrt(( ( doubleval($data['n']) * doubleval($data['sigma_xx'][$index]) ) - doubleval($data['sigmax_sigmax'][$index]) ) * ( ( doubleval($data['n']) * doubleval($data['sigma_yy']) ) - doubleval($data['sigmay_sigmay']) )));
                        $r_format = number_format($r_count, 4, ',', '');
                    @endphp
                    <div class="text-center">
                        <strong>CONCLUTION : </strong>
                    </div>
                    <div class="text-center">
                        @if($r_count < doubleval($data['r_table']))
                                because r <sub>count</sub> < r <sub>table</sub> or {{ $r_format }} < {{ $data['r_table'] }}, data {{ $index+1 }} is <br /><q> <strong>Not Valid</strong> </q>
                        @else
                            because r <sub>table</sub> < r <sub>count</sub> or {{ $data['r_table'] }} < {{ $r_format }}, data {{ $index+1 }} is <br /><q> <strong>Valid</strong> </q>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
