## Configuration

The website is entirely configured by the file `data.json` in the [data branch](https://github.com/RiedleroD/StrangeMatter_Portfolio/tree/data).

A structure guide is provided in `example.json`.

A few notes on structure that weren't possible to include in `example.json`:
- no trailing commas in lists (i.e. `[1,2,3,]` is forbidden)
- line breaks in strings have to be replaced with \n
- other "escape characters" in strings include \" for double quotes and \\ for a backslash
- all other characters, including unicode symbols should be supported
- Links to sources can either be written as `/path/to/file.png`, which will resolve to https://riedler.wien/path/to/file.png, 
  as `https://server.net/path/to/file.jpg` or as `$file.svg`, which will resolve to the corresponding file in the imgs folder in the data branch
- If anything breaks after you edit the config, just tell Riedler & he'll ~~fucking whoop your ass~~ help you.
