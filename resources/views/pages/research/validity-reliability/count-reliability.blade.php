@php
    $variansItemTotal = 0;
    $variansTotal = 0;
    $reliableValue = 0;
@endphp

<div class="d-flex flex-wrap">
    @foreach ($data['sigma_x'] as $index => $dt)
        <div class="col-md-6 col-12">
            <div class="mx-md-3 mx-2 my-2 border border-white p-md-3 p-2 rounded">
                <div>
                    Varians items {{ $index + 1 }} ( s<sub>{{ $index + 1 }}</sub> )<br />
                    <hr>
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <msup>
                                    <msub>
                                        <mi>s</mi>
                                        <mn>{{ $index + 1 }}</mn>
                                    </msub>
                                    <mn>2</mn>
                                </msup>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ $data['sigma_xr'][$index] }}</mi>
                                        <mi>&nbsp; - &nbsp;</mi>
                                        <mfrac>
                                            <mrow class="mb-2">
                                                <msup>
                                                    <mi>{{ $data['sigma_x'][$index] }}</mi>
                                                    <mn>2</mn>
                                                </msup>
                                            </mrow>
                                            <mrow class="mt-2">
                                                <mi>{{ $data['n'] }}</mi>
                                            </mrow>
                                        </mfrac>
                                    </mrow>
                                    <mrow>
                                        <mi>{{ $data['n'] }}</mi>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <msup>
                                    <msub>
                                        <mi>s</mi>
                                        <mn>{{ $index + 1 }}</mn>
                                    </msub>
                                    <mn>2</mn>
                                </msup>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ $data['sigma_xr'][$index] }}</mi>
                                        <mi>&nbsp; - &nbsp;</mi>
                                        <mfrac>
                                            <mrow class="mb-2">
                                                <mi>{{ pow($data['sigma_x'][$index], 2) }}</mi>
                                            </mrow>
                                            <mrow class="mt-2">
                                                <mi>{{ $data['n'] }}</mi>
                                            </mrow>
                                        </mfrac>
                                    </mrow>
                                    <mrow>
                                        <mi>{{ $data['n'] }}</mi>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <msup>
                                    <msub>
                                        <mi>s</mi>
                                        <mn>{{ $index + 1 }}</mn>
                                    </msub>
                                    <mn>2</mn>
                                </msup>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ $data['sigma_xr'][$index] }}</mi>
                                        <mi>&nbsp; - &nbsp;</mi>
                                        <mi>{{ pow($data['sigma_x'][$index], 2) / $data['n'] }}</mi>
                                    </mrow>
                                    <mrow>
                                        <mi>{{ $data['n'] }}</mi>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <msup>
                                    <msub>
                                        <mi>s</mi>
                                        <mn>{{ $index + 1 }}</mn>
                                    </msub>
                                    <mn>2</mn>
                                </msup>
                                <mo>=</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ ( $data['sigma_xr'][$index] ) - ( pow($data['sigma_x'][$index], 2) / $data['n'] ) }}</mi>
                                    </mrow>
                                    <mrow>
                                        <mi>{{ $data['n'] }}</mi>
                                    </mrow>
                                </mfrac>
                            </mrow>
                        </semantics>
                    </math>
                    <br /><br />
                    <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                        <semantics>
                            <mrow>
                                <msup>
                                    <msub>
                                        <mi>s</mi>
                                        <mn>{{ $index + 1 }}</mn>
                                    </msub>
                                    <mn>2</mn>
                                </msup>
                                <mo>=</mo>
                                <mi>{{ ( ( $data['sigma_xr'][$index] ) - ( pow($data['sigma_x'][$index], 2) / $data['n'] ) ) / ( $data['n'] ) }}</mi>
                                @php
                                    $variansItemTotal += ( ( $data['sigma_xr'][$index] ) - ( pow($data['sigma_x'][$index], 2) / $data['n'] ) ) / ( $data['n'] );
                                @endphp
                            </mrow>
                        </semantics>
                    </math>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="bg-secondary p-2 mt-3 rounded">
    <div class="text-center">
        <strong>VARIANS ITEM TOTAL : </strong>
    </div>
    <div class="text-center">
        {{ $variansItemTotal }}
    </div>
</div>
<hr>
<div>
    <div class="col-12">
        <div class="mx-md-3 mx-2 my-2 border border-white p-md-3 p-2 rounded">
            <div>
                Varians Total<br />
                <hr>
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <msup>
                                <msub>
                                    <mi>s</mi>
                                    <mn>t</mn>
                                </msub>
                                <mn>2</mn>
                            </msup>
                            <mo>=</mo>
                            <mfrac>
                                <mrow class="mb-2">
                                    <mi>{{ $data['sigma_yy'] }}</mi>
                                    <mi>&nbsp; - &nbsp;</mi>
                                    <mfrac>
                                        <mrow class="mb-2">
                                            <msup>
                                                <mi>{{ $data['sigma_y'] }}</mi>
                                                <mn>2</mn>
                                            </msup>
                                        </mrow>
                                        <mrow class="mt-2">
                                            <mi>{{ $data['n'] }}</mi>
                                        </mrow>
                                    </mfrac>
                                </mrow>
                                <mrow>
                                    <mi>{{ $data['n'] }}</mi>
                                </mrow>
                            </mfrac>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <msup>
                                <msub>
                                    <mi>s</mi>
                                    <mn>t</mn>
                                </msub>
                                <mn>2</mn>
                            </msup>
                            <mo>=</mo>
                            <mfrac>
                                <mrow class="mb-2">
                                    <mi>{{ $data['sigma_yy'] }}</mi>
                                    <mi>&nbsp; - &nbsp;</mi>
                                    <mfrac>
                                        <mrow class="mb-2">
                                            <mi>{{ pow($data['sigma_y'], 2) }}</mi>
                                        </mrow>
                                        <mrow class="mt-2">
                                            <mi>{{ $data['n'] }}</mi>
                                        </mrow>
                                    </mfrac>
                                </mrow>
                                <mrow>
                                    <mi>{{ $data['n'] }}</mi>
                                </mrow>
                            </mfrac>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <msup>
                                <msub>
                                    <mi>s</mi>
                                    <mn>t</mn>
                                </msub>
                                <mn>2</mn>
                            </msup>
                            <mo>=</mo>
                            <mfrac>
                                <mrow class="mb-2">
                                    <mi>{{ $data['sigma_yy'] }}</mi>
                                    <mi>&nbsp; - &nbsp;</mi>
                                    <mi>{{ pow($data['sigma_y'], 2) / $data['n'] }}</mi>
                                </mrow>
                                <mrow>
                                    <mi>{{ $data['n'] }}</mi>
                                </mrow>
                            </mfrac>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <msup>
                                <msub>
                                    <mi>s</mi>
                                    <mn>t</mn>
                                </msub>
                                <mn>2</mn>
                            </msup>
                            <mo>=</mo>
                            <mfrac>
                                <mrow class="mb-2">
                                    <mi>{{ ( $data['sigma_yy'] ) - ( pow($data['sigma_y'], 2) / $data['n'] ) }}</mi>
                                </mrow>
                                <mrow>
                                    <mi>{{ $data['n'] }}</mi>
                                </mrow>
                            </mfrac>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <msup>
                                <msub>
                                    <mi>s</mi>
                                    <mn>t</mn>
                                </msub>
                                <mn>2</mn>
                            </msup>
                            <mo>=</mo>
                            <mi>{{ ( ( $data['sigma_yy'] ) - ( pow($data['sigma_y'], 2) / $data['n'] ) ) / ( $data['n'] ) }}</mi>
                            @php
                                $variansTotal = ( ( $data['sigma_yy'] ) - ( pow($data['sigma_y'], 2) / $data['n'] ) ) / ( $data['n'] );
                            @endphp
                        </mrow>
                    </semantics>
                </math>
            </div>
        </div>
    </div>
</div>
<div class="bg-secondary p-2 mt-3 rounded">
    <div class="text-center">
        <strong>VARIANS TOTAL : </strong>
    </div>
    <div class="text-center">
        {{ $variansTotal }}
    </div>
</div>
<hr>
<div class="d-flex flex-wrap">
    <div class="col-md-6 col-12">
        <div class="mx-md-3 mx-2 my-2 border border-white p-md-3 p-2 rounded" style="height: 100%">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>r Value</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>r < 0,20</td>
                        <td>Very Low</td>
                    </tr>
                    <tr>
                        <td>0,20 &le; r < 0,40</td>
                        <td>Low</td>
                    </tr>
                    <tr>
                        <td>0,40 &le; r < 0,70</td>
                        <td>Currently</td>
                    </tr>
                    <tr>
                        <td>0,70 &le; r < 0,90</td>
                        <td>High</td>
                    </tr>
                    <tr>
                        <td>0,90 &le; r < 1,00</td>
                        <td>Very High</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="mx-md-3 mx-2 my-2 border border-white p-md-3 p-2 rounded" style="height: 100%">
            <div>
                Reliability Value<br />
                <hr>
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <mo>r</mo>
                            <mo>=</mo>
                            <mo>(</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ count($data['sigma_x']) }}</mi>
                                    </mrow>
                                    <mrow class="mt-2">
                                        <mi>{{ count($data['sigma_x']) }} - 1</mi>
                                    </mrow>
                                </mfrac>
                            <mo>)</mo>
                            <mo>(</mo>
                                <mi>1</mi>
                                <mo> - </mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ $variansItemTotal }}</mi>
                                    </mrow>
                                    <mrow class="mt-2">
                                        <mi>{{ $variansTotal }}</mi>
                                    </mrow>
                                </mfrac>
                            <mo>)</mo>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <mo>r</mo>
                            <mo>=</mo>
                            <mo>(</mo>
                                <mfrac>
                                    <mrow class="mb-2">
                                        <mi>{{ count($data['sigma_x']) }}</mi>
                                    </mrow>
                                    <mrow class="mt-2">
                                        <mi>{{ count($data['sigma_x']) - 1 }}</mi>
                                    </mrow>
                                </mfrac>
                            <mo>)</mo>
                            <mo>(</mo>
                                <mi>1</mi>
                                <mo> - </mo>
                                <mi>{{ doubleval($variansItemTotal) / doubleval($variansTotal) }}</mi>
                            <mo>)</mo>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <mo>r</mo>
                            <mo>=</mo>
                            <mo>(</mo>
                            <mi>{{ ( count($data['sigma_x']) ) / ( count($data['sigma_x']) - 1 ) }}</mi>
                            <mo>)</mo>
                            <mo>(</mo>
                                <mi>{{ 1 - ( doubleval($variansItemTotal) / doubleval($variansTotal) ) }}</mi>
                            <mo>)</mo>
                        </mrow>
                    </semantics>
                </math>
                <br /><br />
                <math mode="display" xmlns="http://www.w3.org/1998/Math/MathML">
                    <semantics>
                        <mrow>
                            <mo>r</mo>
                            <mo>=</mo>
                            <mi>{{ number_format((( ( count($data['sigma_x']) ) / ( count($data['sigma_x']) - 1 ) ) * ( 1 - ( doubleval($variansItemTotal) / doubleval($variansTotal) ) )), 2, '.', '') }}</mi>
                            @php
                                $reliableValue = number_format((( ( count($data['sigma_x']) ) / ( count($data['sigma_x']) - 1 ) ) * ( 1 - ( doubleval($variansItemTotal) / doubleval($variansTotal) ) )), 2, '.', '');
                            @endphp
                        </mrow>
                    </semantics>
                </math>
            </div>
        </div>
    </div>
</div>
<div class="bg-secondary p-2 mt-3 rounded">
    <div class="text-center">
        <strong>CONCLUTION : </strong>
    </div>
    <div class="text-center">
        the value of r is equal to <strong>{{ $reliableValue }}</strong> that has a
        <strong>
            @if (doubleval($reliableValue) < 0.20)
                Very Low
            @elseif (doubleval($reliableValue) >= 0.20 && doubleval($reliableValue) < 0.40)
                Low
            @elseif (doubleval($reliableValue) >= 0.40 && doubleval($reliableValue) < 0.70)
                Currently
            @elseif (doubleval($reliableValue) >= 0.70 && doubleval($reliableValue) < 0.90)
                High
            @elseif (doubleval($reliableValue) >= 0.90 && doubleval($reliableValue) < 0.10)
                Very High
            @endif
        </strong>
        description<br />
        beause the value is @if (doubleval($reliableValue) < 0.50) under @else above @endif 0.5 that mean the data is <strong> @if (doubleval($reliableValue) < 0.50) Nor Reliable @else Reliable @endif </strong>
    </div>
</div>
