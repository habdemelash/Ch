<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' kan :attribute galchiin fudhatama qabaachu qaba.',
    'accepted_if' => 'kan :attribute galchiin kan :other galchiin :value yeroo tau fudhatama qabaachu qaba.',
    'active_url' => 'kan :attribute galchiin yu.ar.el sirrii miti.',
    'after' => 'kan :attribute guyyaa galchii :date irraa booda tau qaba.',
    'after_or_equal' => 'kan :attribute guyyaa galchii :date irraa walqixa yookan booda tau qaba.',
    'alpha' => 'kan :attribute galchiin qubeewwan qofa tau qaba. ',
    'alpha_dash' => 'kan :attribute galchiin qubeewwan,lakkofsoota,sararawwan fi xuqaallee qofa tau qaba.',
    'alpha_num' => 'kan :attribute galchiin qubeewwan fi lakkofsoota qofa tau qaba',
    'array' => 'kan :attribute galchiin walhordooffu qaba. ',
    'before' => 'kan :attribute guyyaa galchii :date irraa dura tau qaba.',
    'before_or_equal' => 'kan :attribute guyyaa galchii :date irraa walqixa yookan dura tau qaba.',
    'between' => [
        'array' => 'kan :attribute galchiin :min fi :max gidduuti tau qaba.',
        'file' => 'kan :attribute galchiin kiiloobayittin  :min fi :max gidduuti tau qaba.',
        'numeric' => 'kan :attribute galchiin  :min fi :max gidduuti tau qaba.',
        'string' => 'kan :attribute galchiin baayina qulfiin :min fi :max gidduuti tau qaba.',
    ],
    'boolean' => 'kan :attribute galchiin dhugaa yookan soba tau qaba.',
    'confirmed' => 'kan :attribute mirkaneffanoon walhinfakkaane.',
    'current_password' => 'jechaa darbii sirrii hin taanedha.',
    'date' => 'kan :attribute galchiin guyyaa sirrii miti. ',
    'date_equals' => 'kan :attribute guyyaan galchii :date irraa walqixa tau qaba.',
    'date_format' => 'kan :attribute caasaan galchii :format irraa walhinfakkaatu.',
    'declined' => 'kan :attribute galchiin fudhatama hin qabu.',
    'declined_if' => 'kan :attribute galchiin kan :other galchii :value yeroo tau fudhatama qabaachu hin qabu.',
    'different' => 'kan :attribute galchiin fi kan :other walfakkaachu hin qabu.',
    'digits' => 'kan :attribute galchiin :digits hamma digitoota tau qaba.',
    'digits_between' => 'kan :attribute galchiin :min fi  :max digitoota gidduu tau qaba. ',
    'dimensions' => 'kan :attribute hanga suurichaa sirrii miti!',
    'distinct' => 'kan :attribute field has a duplicate value.',
    'email' => 'kan :attribute tessoon imeelli sirrii tau qaba.',
    'ends_with' => 'kan :attribute galchii fixu kan qabu asi: :values kessaa yoo xiqaate tokko qabaachu qaba.',
    'enum' => 'kan filatame :attribute galchiin sirrii miti.',
    'exists' => 'kan filatame :attribute galchiin sirrii miti.',
    'file' => 'kan :attribute galchiin faayili tau qaba.',
    'filled' => 'kan :attribute galchiin gatii tae qabaachu qaba.',
    'gt' => [
        'array' => 'kan :attribute galchiin yoo xiqaate :value bal-tokkee qabaachu qaba.',
        'file' => 'kan :attribute galchiin kan kiiloobayittin saffarame :value irraa caalu qaba.',
        'numeric' => 'kan :attribute galchiin kan lakkoofsaan saffarame :value irraa caalu qaba.',
        'string' => 'kan :attribute galchiin kan fuurtuu saffarame :value irraa caalu qaba.',
    ],
    'gte' => [
        'array' => 'kan :attribute galchiin baayina bal-tokkeen kanaa :value walqixa yookan caala qabaachu qaba.',
        'file' => 'kan :attribute galchiin hanga kiiloobayitti kanaa :value walqixa yookan caala qabaachu qaba.',
        'numeric' => 'kan :attribute galchiin lakkoofsaan saffarame kanaa :value walqixa yookan caala qabaachu qaba.',
        'string' => 'kan :attribute galchiin baayina fuurtuun :value walqixa yookan caala qabaachu qaba.',
    ],
    'image' => 'kan :attribute galchiin suuraa tau qaba.',
    'in' => 'kan filatame :attribute galchiin sirrii miti.',
    'in_array' => 'kan :attribute galchiin :other kan kessaa hin argamne.',
    'integer' => 'kan :attribute galchiin lakkoofsa tau qaba.',
    'ip' => 'kan :attribute galchiin teessoon intarnetii protocolii /IP/ sirrii tau qaba.',
    'ipv4' => 'kan :attribute galchiin teessoon intarnetii protocolii 4 /IPv4/ sirrii tau qaba.',
    'ipv6' => 'kan :attribute galchiin teessoon intarnetii protocolii 6 /IPv6/ sirrii tau qaba.',
    'json' => 'kan :attribute galchiin kan JSON fuurtuu sirrii tau qaba.',
    'lt' => [
        'array' => 'kan :attribute galchiin bal-tokkeewwan :value kanaa oli tau hin qabu.',
        'file' => 'kan :attribute haami galchii kiiloobayitti :value kanaa oli tau qabu.',
        'numeric' => 'kan :attribute must be less than :value.',
        'string' => 'kan :attribute haami galchii fuurtuu :value kanaa gadi qabaachu qaba.',
    ],
    'lte' => [
        'array' => 'kan :attribute galchiin bal-tokkeewwan  :value kanaa ol tau hin qabu.',
        'file' => 'kan :attribute haangi galchii kiiloobayitti :value kanaa walqixa yookan gadi tau qaba.',
        'numeric' => 'kan :attribute lakkoofsi galchii :value kanaa walqixa yookan gadi tau qaba.',
        'string' => 'kan :attribute baayini galchii fuurtuu :value kanaa walqixa yookan gadi tau qaba.',
    ],
    'mac_address' => 'kan :attribute galchiin teessoo daddabarsaa maakiin /MAC/ sirrii tau qaba.',
    'max' => [
        'array' => 'kan :attribute galchiin bal-tokkeewwan  :max kana oli tau qaba.',
        'file' => 'kan :attribute galchiin kiiloobayittin :max kanaa oli tau hin qabu.',
        'numeric' => 'kan :attribute galchiin lakkoofsotaa :max kanaa oli tau qaba.',
        'string' => 'kan :attribute galchii fuurtuu :max kanaa oli tau hin qabu.',
    ],
    'mimes' => 'kan :attribute goosni galchii : :values kanaa ala tau hin qabu.',
    'mimetypes' => 'kan :attribute goosni galchii : :values kana keessaa tau qaba.',
    'min' => [
        'array' => 'kan :attribute galchiin bal-tokkeewwan gosa :min yoo xiqaate qabaachu qaba.',
        'file' => 'የ :attribute galchiin kiiloobayittin gosa :min yoo xiqaate tau qaba.',
        'numeric' => 'kan :attribute gatiin galchii :min yoo xiqaate tau qaba.',
        'string' => 'kan :attribute galchiin fuurtoota gosa :min yoo xiqaate tau qaba.',
    ],
    'multiple_of' => 'kan :attribute gatii kan :value baayina tau qaba.',
    'not_in' => 'kan filatame :attribute galchiin sirrii miti.',
    'not_regex' => 'kan :attribute haali barrefamaa sirrii miti.',
    'numeric' => 'kan :attribute lakkoofsa tau qaba.',
    'present' => 'kan :attribute galchiin jiraachu qaba.',
    'prohibited' => 'kan :attribute galchiin dhorkamaa dha.',
    'prohibited_if' => 'kan :attribute field kan galchii :other gatii :value yoo tae dhorkamaa dha.',
    'prohibited_unless' => 'kan :attribute galchiin kan :other galchiin :values irraa keessa waan jiru yoo tae dhorkamaa dha.',
    'prohibits' => 'kan :attribute galchiin kan :other akka gatii hinqabaane dhorka.',
    'regex' => 'kan :attribute haali barrefamaa sirrii miti.',
    'required' => 'kan :attribute galchiin dirqama barbaachisadha.',
    'required_array_keys' => 'kan :attribute field must contain entries for: :values.',
    'required_if' => 'kan :attribute field is required when :other is :value.',
    'required_unless' => 'kan :attribute field is required unless :other is in :values.',
    'required_with' => 'kan :attribute galchiin kan :values galchiin jiraanaan dirqama barbaachisadha.',
    'required_with_all' => 'kan :attribute kan galchiin :values galchiin jiraanaan dirqama barbaachisadha.',
    'required_without' => 'kan :attribute kan galchiin :values galchiin yoo hin jiraane dirqama barbaachisadha.',
    'required_without_all' => 'kan :attribute kan galchii :values galchiin yoo hin jiraane dirqama barbaachisadha.',
    'same' => 'kan :attribute galchiin fi :other galchiin walfakkaachu qaba.',
    'size' => [
        'array' => 'kan :attribute galchiin :size miseensoota hunfaa qabaachu qaba. ',
        'file' => 'kan :attribute galchiin kiiloobaayitiin :size haamana tau qaba.',
        'numeric' => 'kan :attribute hangi galchii :size tau qaba.',
        'string' => 'kan :attribute hangi galchii :size tau qaba.',
    ],
    'starts_with' => 'kan :attribute galchiin kan calqabuu qabu : :values tokko irrayi.',
    'string' => 'kan :attribute galchiin furtuu-walii tau qaba.',
    'timezone' => 'kan :attribute galchiin yeroo sirrii qabaachu qaba. ',
    'unique' => 'kan :attribute galchiin kessan isan dursa qabamerraa. ',
    'uploaded' => 'kan :attribute olbaassun hin milkoofne.',
    'url' => 'kan :attribute galchiin fuldur fi odeffanoo iyyataa yu.ar.el tau qaba.',
    'uuid' => 'kan :attribute galchiin sirrii fi kan waligalchisu tau qaba.',  

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
