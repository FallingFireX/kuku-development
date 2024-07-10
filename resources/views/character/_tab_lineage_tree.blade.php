<div class="container text-center">
---------------------------------------- SSS: Unknown
<br>------------------- SS: Unknown
<br>---------------------------------------- SSD: Unknown
<br><span class="font-weight-bold">Sire</span>: Wraith 15000
<br>---------------------------------------- SDS: Unknown
<br>------------------- SD: Unknown
<br>---------------------------------------- SDD: Unknown
<br>---------------------------------------- DSS: Unknown
<br>------------------- DS: Ouroboros 15006
<br>---------------------------------------- DSD: Unknown
<br><span class="font-weight-bold">Dam</span>: Unknown
<br>---------------------------------------- DDS: Unknown
<br>------------------- DD: Unknown
<br>---------------------------------------- DDD: Unknown
<br><br>
    <div class="row">
        <div class="col">
            <div class="border-bottom mb-1">
                <span class="font-weight-bold">Sire</span><br>{!! $line['sire'] !!}
            </div>
            <div class="row">
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Sire's Sire">SS</abbr><br>{!! $line['sire_sire'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Sire's Sire's Sire">SSS</abbr><br>{!! $line['sire_sire_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Sire's Sire's Dam">SSD</abbr><br>{!! $line['sire_sire_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Sire's Dam">SD</abbr><br>{!! $line['sire_dam'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Sire's Dam's Sire">SDS</abbr><br>{!! $line['sire_dam_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Sire's Dam's Dam">SDD</abbr><br>{!! $line['sire_dam_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-bottom mb-1">
                <span class="font-weight-bold">Dam</span><br>{!! $line['dam'] !!}
            </div>
            <div class="row">
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Dam's Sire">DS</abbr><br>{!! $line['dam_sire'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Dam's Sire's Sire">DSS</abbr><br>{!! $line['dam_sire_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Dam's Sire's Dam">DSD</abbr><br>{!! $line['dam_sire_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="border-bottom mb-1">
                        <abbr class="font-weight-bold" title="Dam's Dam">DD</abbr><br>{!! $line['dam_dam'] !!}
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Dam's Dam's Sire">DDS</abbr><br>{!! $line['dam_dam_sire'] !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-1">
                                <abbr title="Dam's Dam's Dam">DDD</abbr><br>{!! $line['dam_dam_dam'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
