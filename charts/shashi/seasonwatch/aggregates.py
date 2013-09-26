import MySQLdb
import simplejson as json

db = MySQLdb.connect(host="localhost", # your host, usually localhost
                     user="root", # your username
                      passwd="root", # your password
                      db="seasonwatch") # name of the data base

# you must create a Cursor object. It will let
#  you execute all the query you need
cur = db.cursor() 

columns = ["freshleaf_count", "matureleaf_count", "bud_count", "fruit_ripe_count", "fruit_unripe_count", "open_flower_count"]
# values = ["Few", "Many", "Full"]
#
# sql = 'update user_tree_observations set %s = %d where %s = "%s";'
# for c in columns:
#     for v in values:
#         print sql % (c, values.index(v), c, v)
counts = ["freshleaf_count", "matureleaf_count", "bud_count", "fruit_ripe_count", "fruit_unripe_count", "open_flower_count"]

fauna = ["leaf_caterpillar", "flower_butterfly", "flower_bee", "fruit_bird", "fruit_monkey"]

properties = ["is_leaf_mature", "is_leaf_fresh", "is_flower_bud", "is_fruit_ripe", "is_fruit_unripe", "is_flower_open"]

sql = "SELECT YEAR( DATE ) as year, {TYPE}( DATE ) as {TYPE} , COUNT( * ) as count , AVG( {X} ) as avg , STDDEV_SAMP( {X} ) as sdev FROM user_tree_observations_sane WHERE YEAR( DATE ) > 2007 AND {X} is not null GROUP BY YEAR( DATE ) , {TYPE}( DATE ) ORDER BY YEAR( DATE ) , {TYPE}( DATE )"

def replace(sql, type, X):
    return sql.replace("{TYPE}", type).replace("{X}", X)

class DecimalEncoder(json.JSONEncoder):
    def _iterencode(self, o, markers=None):
        if isinstance(o, decimal.Decimal):
            # wanted a simple yield str(o) in the next line,
            # but that would mean a yield on the line with super(...),
            # which wouldn't work (see my comment below), so...
            return (float(str(o)) for o in [o])
        return super(DecimalEncoder, self)._iterencode(o, markers)

for c in counts + fauna + properties:
    for type in ["week", "month"]:
        fn = c + "_" + type + "ly.json"
        query = replace(sql, type, c)
        print query, "->", fn
        cur.execute(query)

        with open("data/" + fn, "w") as f:
            json.dump(cur.fetchall(), f, use_decimal=True)

# print all the first cell of all the rows

#    $data=array();
#    $models = "";
#    function modelCase($name) {
#        $newName = '';
#        $parts = explode('_', $name);
#        foreach ($parts as $part) {
#            $newName .= ucfirst($part);
#        }
#        return $newName;
#    }
#
#    foreach ($json_collections as $collection => $query) {
#
#        echo "$collection -> $query\n";
#        $r=mysql_query($query);
#        if(!$r)
#        {
#            die("query \"$query\" not executed: ".mysql_error());
#        }
#
#        $json_object = array();
#        while($row=mysql_fetch_assoc($r))
#        {
#                $json_object[] = $row;
#        }
#        $data[modelCase($collection)] = $json_object;
#        $models .= sprintf("Data.%s = new Meteor.Collection(\"%s\");\n", modelCase($collection), $collection);
#    }
#
#    file_put_contents("data.js" , "self=this; if (Meteor.isServer) { self.DataSet=" . json_encode($data). "; };");
#    file_put_contents("models.js" , "Data = {}; " . $models);

