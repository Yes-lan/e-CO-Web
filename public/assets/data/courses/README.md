# Courses Data Directory

This directory will contain JSON files for created courses.

## Structure

Each course will have multiple related files:

### Course Info File
`course_[timestamp].json`
```json
{
  "name": "Course Name",
  "description": "Course description",
  "location": "Location name",
  "created_at": "ISO date string",
  "waypoints_file": "waypoints_[timestamp].json",
  "boundaries_file": "boundaries_[timestamp].json"
}
```

### Waypoints File
`waypoints_[timestamp].json`
```json
{
  "description": "Waypoints for course [name]",
  "waypoints": [
    {
      "id": 1,
      "lat": 45.828500,
      "lng": 1.256800,
      "type": "start"
    },
    {
      "id": 2,
      "lat": 45.827800,
      "lng": 1.257200,
      "type": "control"
    }
  ]
}
```

### Boundaries File (Optional)
`boundaries_[timestamp].json`
```json
{
  "description": "Boundary points for course [name]",
  "points": [
    {
      "id": 1,
      "lat": 45.828969,
      "lng": 1.257548
    }
  ]
}
```

## Note

In production, these files would be stored in a database. For now, they serve as plain JSON storage for testing purposes.
