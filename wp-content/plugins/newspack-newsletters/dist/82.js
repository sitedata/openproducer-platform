(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[82],{

/***/ "./node_modules/codemirror/mode/powershell/powershell.js":
/*!***************************************************************!*\
  !*** ./node_modules/codemirror/mode/powershell/powershell.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// CodeMirror, copyright (c) by Marijn Haverbeke and others\n// Distributed under an MIT license: https://codemirror.net/LICENSE\n\n(function(mod) {\n  'use strict';\n  if (true) // CommonJS\n    mod(__webpack_require__(/*! ../../lib/codemirror */ \"./node_modules/codemirror/lib/codemirror.js\"));\n  else {}\n})(function(CodeMirror) {\n'use strict';\n\nCodeMirror.defineMode('powershell', function() {\n  function buildRegexp(patterns, options) {\n    options = options || {};\n    var prefix = options.prefix !== undefined ? options.prefix : '^';\n    var suffix = options.suffix !== undefined ? options.suffix : '\\\\b';\n\n    for (var i = 0; i < patterns.length; i++) {\n      if (patterns[i] instanceof RegExp) {\n        patterns[i] = patterns[i].source;\n      }\n      else {\n        patterns[i] = patterns[i].replace(/[-\\/\\\\^$*+?.()|[\\]{}]/g, '\\\\$&');\n      }\n    }\n\n    return new RegExp(prefix + '(' + patterns.join('|') + ')' + suffix, 'i');\n  }\n\n  var notCharacterOrDash = '(?=[^A-Za-z\\\\d\\\\-_]|$)';\n  var varNames = /[\\w\\-:]/\n  var keywords = buildRegexp([\n    /begin|break|catch|continue|data|default|do|dynamicparam/,\n    /else|elseif|end|exit|filter|finally|for|foreach|from|function|if|in/,\n    /param|process|return|switch|throw|trap|try|until|where|while/\n  ], { suffix: notCharacterOrDash });\n\n  var punctuation = /[\\[\\]{},;`\\\\\\.]|@[({]/;\n  var wordOperators = buildRegexp([\n    'f',\n    /b?not/,\n    /[ic]?split/, 'join',\n    /is(not)?/, 'as',\n    /[ic]?(eq|ne|[gl][te])/,\n    /[ic]?(not)?(like|match|contains)/,\n    /[ic]?replace/,\n    /b?(and|or|xor)/\n  ], { prefix: '-' });\n  var symbolOperators = /[+\\-*\\/%]=|\\+\\+|--|\\.\\.|[+\\-*&^%:=!|\\/]|<(?!#)|(?!#)>/;\n  var operators = buildRegexp([wordOperators, symbolOperators], { suffix: '' });\n\n  var numbers = /^((0x[\\da-f]+)|((\\d+\\.\\d+|\\d\\.|\\.\\d+|\\d+)(e[\\+\\-]?\\d+)?))[ld]?([kmgtp]b)?/i;\n\n  var identifiers = /^[A-Za-z\\_][A-Za-z\\-\\_\\d]*\\b/;\n\n  var symbolBuiltins = /[A-Z]:|%|\\?/i;\n  var namedBuiltins = buildRegexp([\n    /Add-(Computer|Content|History|Member|PSSnapin|Type)/,\n    /Checkpoint-Computer/,\n    /Clear-(Content|EventLog|History|Host|Item(Property)?|Variable)/,\n    /Compare-Object/,\n    /Complete-Transaction/,\n    /Connect-PSSession/,\n    /ConvertFrom-(Csv|Json|SecureString|StringData)/,\n    /Convert-Path/,\n    /ConvertTo-(Csv|Html|Json|SecureString|Xml)/,\n    /Copy-Item(Property)?/,\n    /Debug-Process/,\n    /Disable-(ComputerRestore|PSBreakpoint|PSRemoting|PSSessionConfiguration)/,\n    /Disconnect-PSSession/,\n    /Enable-(ComputerRestore|PSBreakpoint|PSRemoting|PSSessionConfiguration)/,\n    /(Enter|Exit)-PSSession/,\n    /Export-(Alias|Clixml|Console|Counter|Csv|FormatData|ModuleMember|PSSession)/,\n    /ForEach-Object/,\n    /Format-(Custom|List|Table|Wide)/,\n    new RegExp('Get-(Acl|Alias|AuthenticodeSignature|ChildItem|Command|ComputerRestorePoint|Content|ControlPanelItem|Counter|Credential'\n      + '|Culture|Date|Event|EventLog|EventSubscriber|ExecutionPolicy|FormatData|Help|History|Host|HotFix|Item|ItemProperty|Job'\n      + '|Location|Member|Module|PfxCertificate|Process|PSBreakpoint|PSCallStack|PSDrive|PSProvider|PSSession|PSSessionConfiguration'\n      + '|PSSnapin|Random|Service|TraceSource|Transaction|TypeData|UICulture|Unique|Variable|Verb|WinEvent|WmiObject)'),\n    /Group-Object/,\n    /Import-(Alias|Clixml|Counter|Csv|LocalizedData|Module|PSSession)/,\n    /ImportSystemModules/,\n    /Invoke-(Command|Expression|History|Item|RestMethod|WebRequest|WmiMethod)/,\n    /Join-Path/,\n    /Limit-EventLog/,\n    /Measure-(Command|Object)/,\n    /Move-Item(Property)?/,\n    new RegExp('New-(Alias|Event|EventLog|Item(Property)?|Module|ModuleManifest|Object|PSDrive|PSSession|PSSessionConfigurationFile'\n      + '|PSSessionOption|PSTransportOption|Service|TimeSpan|Variable|WebServiceProxy|WinEvent)'),\n    /Out-(Default|File|GridView|Host|Null|Printer|String)/,\n    /Pause/,\n    /(Pop|Push)-Location/,\n    /Read-Host/,\n    /Receive-(Job|PSSession)/,\n    /Register-(EngineEvent|ObjectEvent|PSSessionConfiguration|WmiEvent)/,\n    /Remove-(Computer|Event|EventLog|Item(Property)?|Job|Module|PSBreakpoint|PSDrive|PSSession|PSSnapin|TypeData|Variable|WmiObject)/,\n    /Rename-(Computer|Item(Property)?)/,\n    /Reset-ComputerMachinePassword/,\n    /Resolve-Path/,\n    /Restart-(Computer|Service)/,\n    /Restore-Computer/,\n    /Resume-(Job|Service)/,\n    /Save-Help/,\n    /Select-(Object|String|Xml)/,\n    /Send-MailMessage/,\n    new RegExp('Set-(Acl|Alias|AuthenticodeSignature|Content|Date|ExecutionPolicy|Item(Property)?|Location|PSBreakpoint|PSDebug' +\n               '|PSSessionConfiguration|Service|StrictMode|TraceSource|Variable|WmiInstance)'),\n    /Show-(Command|ControlPanelItem|EventLog)/,\n    /Sort-Object/,\n    /Split-Path/,\n    /Start-(Job|Process|Service|Sleep|Transaction|Transcript)/,\n    /Stop-(Computer|Job|Process|Service|Transcript)/,\n    /Suspend-(Job|Service)/,\n    /TabExpansion2/,\n    /Tee-Object/,\n    /Test-(ComputerSecureChannel|Connection|ModuleManifest|Path|PSSessionConfigurationFile)/,\n    /Trace-Command/,\n    /Unblock-File/,\n    /Undo-Transaction/,\n    /Unregister-(Event|PSSessionConfiguration)/,\n    /Update-(FormatData|Help|List|TypeData)/,\n    /Use-Transaction/,\n    /Wait-(Event|Job|Process)/,\n    /Where-Object/,\n    /Write-(Debug|Error|EventLog|Host|Output|Progress|Verbose|Warning)/,\n    /cd|help|mkdir|more|oss|prompt/,\n    /ac|asnp|cat|cd|chdir|clc|clear|clhy|cli|clp|cls|clv|cnsn|compare|copy|cp|cpi|cpp|cvpa|dbp|del|diff|dir|dnsn|ebp/,\n    /echo|epal|epcsv|epsn|erase|etsn|exsn|fc|fl|foreach|ft|fw|gal|gbp|gc|gci|gcm|gcs|gdr|ghy|gi|gjb|gl|gm|gmo|gp|gps/,\n    /group|gsn|gsnp|gsv|gu|gv|gwmi|h|history|icm|iex|ihy|ii|ipal|ipcsv|ipmo|ipsn|irm|ise|iwmi|iwr|kill|lp|ls|man|md/,\n    /measure|mi|mount|move|mp|mv|nal|ndr|ni|nmo|npssc|nsn|nv|ogv|oh|popd|ps|pushd|pwd|r|rbp|rcjb|rcsn|rd|rdr|ren|ri/,\n    /rjb|rm|rmdir|rmo|rni|rnp|rp|rsn|rsnp|rujb|rv|rvpa|rwmi|sajb|sal|saps|sasv|sbp|sc|select|set|shcm|si|sl|sleep|sls/,\n    /sort|sp|spjb|spps|spsv|start|sujb|sv|swmi|tee|trcm|type|where|wjb|write/\n  ], { prefix: '', suffix: '' });\n  var variableBuiltins = buildRegexp([\n    /[$?^_]|Args|ConfirmPreference|ConsoleFileName|DebugPreference|Error|ErrorActionPreference|ErrorView|ExecutionContext/,\n    /FormatEnumerationLimit|Home|Host|Input|MaximumAliasCount|MaximumDriveCount|MaximumErrorCount|MaximumFunctionCount/,\n    /MaximumHistoryCount|MaximumVariableCount|MyInvocation|NestedPromptLevel|OutputEncoding|Pid|Profile|ProgressPreference/,\n    /PSBoundParameters|PSCommandPath|PSCulture|PSDefaultParameterValues|PSEmailServer|PSHome|PSScriptRoot|PSSessionApplicationName/,\n    /PSSessionConfigurationName|PSSessionOption|PSUICulture|PSVersionTable|Pwd|ShellId|StackTrace|VerbosePreference/,\n    /WarningPreference|WhatIfPreference/,\n\n    /Event|EventArgs|EventSubscriber|Sender/,\n    /Matches|Ofs|ForEach|LastExitCode|PSCmdlet|PSItem|PSSenderInfo|This/,\n    /true|false|null/\n  ], { prefix: '\\\\$', suffix: '' });\n\n  var builtins = buildRegexp([symbolBuiltins, namedBuiltins, variableBuiltins], { suffix: notCharacterOrDash });\n\n  var grammar = {\n    keyword: keywords,\n    number: numbers,\n    operator: operators,\n    builtin: builtins,\n    punctuation: punctuation,\n    identifier: identifiers\n  };\n\n  // tokenizers\n  function tokenBase(stream, state) {\n    // Handle Comments\n    //var ch = stream.peek();\n\n    var parent = state.returnStack[state.returnStack.length - 1];\n    if (parent && parent.shouldReturnFrom(state)) {\n      state.tokenize = parent.tokenize;\n      state.returnStack.pop();\n      return state.tokenize(stream, state);\n    }\n\n    if (stream.eatSpace()) {\n      return null;\n    }\n\n    if (stream.eat('(')) {\n      state.bracketNesting += 1;\n      return 'punctuation';\n    }\n\n    if (stream.eat(')')) {\n      state.bracketNesting -= 1;\n      return 'punctuation';\n    }\n\n    for (var key in grammar) {\n      if (stream.match(grammar[key])) {\n        return key;\n      }\n    }\n\n    var ch = stream.next();\n\n    // single-quote string\n    if (ch === \"'\") {\n      return tokenSingleQuoteString(stream, state);\n    }\n\n    if (ch === '$') {\n      return tokenVariable(stream, state);\n    }\n\n    // double-quote string\n    if (ch === '\"') {\n      return tokenDoubleQuoteString(stream, state);\n    }\n\n    if (ch === '<' && stream.eat('#')) {\n      state.tokenize = tokenComment;\n      return tokenComment(stream, state);\n    }\n\n    if (ch === '#') {\n      stream.skipToEnd();\n      return 'comment';\n    }\n\n    if (ch === '@') {\n      var quoteMatch = stream.eat(/[\"']/);\n      if (quoteMatch && stream.eol()) {\n        state.tokenize = tokenMultiString;\n        state.startQuote = quoteMatch[0];\n        return tokenMultiString(stream, state);\n      } else if (stream.eol()) {\n        return 'error';\n      } else if (stream.peek().match(/[({]/)) {\n        return 'punctuation';\n      } else if (stream.peek().match(varNames)) {\n        // splatted variable\n        return tokenVariable(stream, state);\n      }\n    }\n    return 'error';\n  }\n\n  function tokenSingleQuoteString(stream, state) {\n    var ch;\n    while ((ch = stream.peek()) != null) {\n      stream.next();\n\n      if (ch === \"'\" && !stream.eat(\"'\")) {\n        state.tokenize = tokenBase;\n        return 'string';\n      }\n    }\n\n    return 'error';\n  }\n\n  function tokenDoubleQuoteString(stream, state) {\n    var ch;\n    while ((ch = stream.peek()) != null) {\n      if (ch === '$') {\n        state.tokenize = tokenStringInterpolation;\n        return 'string';\n      }\n\n      stream.next();\n      if (ch === '`') {\n        stream.next();\n        continue;\n      }\n\n      if (ch === '\"' && !stream.eat('\"')) {\n        state.tokenize = tokenBase;\n        return 'string';\n      }\n    }\n\n    return 'error';\n  }\n\n  function tokenStringInterpolation(stream, state) {\n    return tokenInterpolation(stream, state, tokenDoubleQuoteString);\n  }\n\n  function tokenMultiStringReturn(stream, state) {\n    state.tokenize = tokenMultiString;\n    state.startQuote = '\"'\n    return tokenMultiString(stream, state);\n  }\n\n  function tokenHereStringInterpolation(stream, state) {\n    return tokenInterpolation(stream, state, tokenMultiStringReturn);\n  }\n\n  function tokenInterpolation(stream, state, parentTokenize) {\n    if (stream.match('$(')) {\n      var savedBracketNesting = state.bracketNesting;\n      state.returnStack.push({\n        /*jshint loopfunc:true */\n        shouldReturnFrom: function(state) {\n          return state.bracketNesting === savedBracketNesting;\n        },\n        tokenize: parentTokenize\n      });\n      state.tokenize = tokenBase;\n      state.bracketNesting += 1;\n      return 'punctuation';\n    } else {\n      stream.next();\n      state.returnStack.push({\n        shouldReturnFrom: function() { return true; },\n        tokenize: parentTokenize\n      });\n      state.tokenize = tokenVariable;\n      return state.tokenize(stream, state);\n    }\n  }\n\n  function tokenComment(stream, state) {\n    var maybeEnd = false, ch;\n    while ((ch = stream.next()) != null) {\n      if (maybeEnd && ch == '>') {\n          state.tokenize = tokenBase;\n          break;\n      }\n      maybeEnd = (ch === '#');\n    }\n    return 'comment';\n  }\n\n  function tokenVariable(stream, state) {\n    var ch = stream.peek();\n    if (stream.eat('{')) {\n      state.tokenize = tokenVariableWithBraces;\n      return tokenVariableWithBraces(stream, state);\n    } else if (ch != undefined && ch.match(varNames)) {\n      stream.eatWhile(varNames);\n      state.tokenize = tokenBase;\n      return 'variable-2';\n    } else {\n      state.tokenize = tokenBase;\n      return 'error';\n    }\n  }\n\n  function tokenVariableWithBraces(stream, state) {\n    var ch;\n    while ((ch = stream.next()) != null) {\n      if (ch === '}') {\n        state.tokenize = tokenBase;\n        break;\n      }\n    }\n    return 'variable-2';\n  }\n\n  function tokenMultiString(stream, state) {\n    var quote = state.startQuote;\n    if (stream.sol() && stream.match(new RegExp(quote + '@'))) {\n      state.tokenize = tokenBase;\n    }\n    else if (quote === '\"') {\n      while (!stream.eol()) {\n        var ch = stream.peek();\n        if (ch === '$') {\n          state.tokenize = tokenHereStringInterpolation;\n          return 'string';\n        }\n\n        stream.next();\n        if (ch === '`') {\n          stream.next();\n        }\n      }\n    }\n    else {\n      stream.skipToEnd();\n    }\n\n    return 'string';\n  }\n\n  var external = {\n    startState: function() {\n      return {\n        returnStack: [],\n        bracketNesting: 0,\n        tokenize: tokenBase\n      };\n    },\n\n    token: function(stream, state) {\n      return state.tokenize(stream, state);\n    },\n\n    blockCommentStart: '<#',\n    blockCommentEnd: '#>',\n    lineComment: '#',\n    fold: 'brace'\n  };\n  return external;\n});\n\nCodeMirror.defineMIME('application/x-powershell', 'powershell');\n});\n\n\n//# sourceURL=webpack:///./node_modules/codemirror/mode/powershell/powershell.js?");

/***/ })

}]);