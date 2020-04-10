for file in *.piko; do cp "$file" "$(basename "$file" .piko).png"
done

